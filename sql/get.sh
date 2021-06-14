#! /bin/ksh
#! @brief    BRIEF_DESCRIPTION_HERE
#! @revision 2021-05-31 (Mon) 12:13:22

curl -SsL --request GET --url http://localhost/sandbox/sam/mobile/tmp/rest-2/docs/api/index.php/post/${1:-1} | jq .

# __END__

