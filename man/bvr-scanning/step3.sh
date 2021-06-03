#!/bin/ksh

integer -s count=0 diffs=0
typeset path=${0%/*}; [[ -z $path || $path == $0 ]] && path=.; path+="/t3"
typeset execjs=node_modules/pdf2json/pdf2json.js
typeset agency; time for agency in dc de ef fd nd or pa sc va LAST; do

    [[ $agency == LAST ]] && {
        # We do this in the for loop so as to be counted in the time(1)'d execution

        (( diffs == 0 )) && {
            print -u2 "# All outputs matched approriately ($count agencies)"
            exit 0
        }

        typeset failed=$(wc -l $path/*/out.diff | head -$diffs | sed  "s,^.*$path/,,;s,/out.diff,,")
        typeset percent=$(print -f "%ld%%" $(( ((diffs * 1.0) / (count * 1.0)) * 100 )) )

        print -u2 "# $percent agencies failed totally or partially: " $failed
        exit 1

    }

    typeset source=$path/$agency/pdf
    typeset target=$path/$agency/out
    typeset master=$path/$agency/master

    rm -rf $target/ $target.diff 2>/dev/null || {
        print -u2 "not ok # $agency: failed to cleanup environment."
        continue
    }

    mkdir -p $target 2>/dev/null || {
        print -u2 "not ok # $agency: failed to create output folder."
        continue
    }

    node $execjs -f $source -o $target -s -t -c >/dev/null 2>&1 || {
        print -u2 "not ok # $agency: failed to execute pdf2json."
        continue
    }

    (( ++ count ))

    diff -rq $target $master >$target.diff 2>/dev/null || {
        print -u2 "not ok # $agency: output doesn't match expected output."
        (( ++ diffs ))
        continue
    }

    print -u2 "ok # $agency output is as expected.\n"

done


