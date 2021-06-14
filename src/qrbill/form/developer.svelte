<script lang="ts">
import { Icon, Col, Container, Row } from 'sveltestrap5';
import { Badge, Button, Form, FormGroup, FormText, Input, Label } from 'sveltestrap5';
import { Card, CardBody, CardFooter, CardHeader, CardSubtitle, CardText, CardTitle } from 'sveltestrap5';
import { qrbill } from '../store/qrbills';
import { qrdata2array, qrbill2sql  } from '../../lib/stdlib/qrbill';
import rc from '../prefs';

function qrupdate   () { qrdata2array ($qrbill.data, $qrbill, $rc.prefs) }

function reset () {
    $qrbill.data = null
    if (!$rc.prefs.use_samples) return
    $rc.prefs.use_samples = false
    location.reload()
}

let sqlcommand; $: sqlcommand = qrbill2sql ($qrbill, $rc.prefs)

function use_sample () {
    $qrbill.data = samples[sample_id]
    if (sample_id > 0) qrupdate ()
}
let sample_id = 0
let samples = [
    /* none  */ null,
    /* 01-de */ "SPC\n0200\n1\nCH6431961000004421557\nS\nKrankenkasse fit&munter\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n\n\n1"
              + "11.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nQRR\n000008207791225857421286694\nMonatsprämie "
              + "Juli 2020\nEPD\n\n",
    /* 01-en */ "SPC\n0200\n1\nCH6431961000004421557\nS\nHealth insurance fit&kicking\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n"
              + "\n\n111.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nQRR\n000008207791225857421286694\nPremium "
              + "calculation July 2020\nEPD\n\n",
    /* 01-fr */ "SPC\n0200\n1\nCH6431961000004421557\nS\nCompagnie d'assurance forme&alerte\nAm Wasser\n1\n3000\nBerne\nCH\n\n"
              + "\n\n\n\n\n\n111.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThoune\nCH\nQRR\n000008207791225857421286694"
              + "\nPrime mensuelle juillet 2020\nEPD\n\n",
    /* 01-it */ "SPC\n0200\n1\nCH6431961000004421557\nS\nCompagnia di assicurazione forma&scalciante\nAm Wasser\n1\n3000\nBerna"
              + "\nCH\n\n\n\n\n\n\n\n111.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nQRR\n000008207791225857421"
              + "286694\nPremio mensile luglio 2020\nEPD\n\n",
    /* 02-de */ "SPC\n0200\n1\nCH6631996000002544373\nK\nStiftung Bessere Welt\nPostfach\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nQRR\n000006317171245565959226487\n\nEPD\n\n",
    /* 02-en */ "SPC\n0200\n1\nCH6631996000002544373\nK\nBetter World Foundation\nPO Box\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nQRR\n000006317171245565959226487\n\nEPD\n\n",
    /* 02-fr */ "SPC\n0200\n1\nCH6631996000002544373\nK\nFondation monde meilleur\nCase postale\n3001 Berne\n\n\nCH\n\n\n\n\n\n"
              + "\n\n\nCHF\n\n\n\n\n\n\n\nQRR\n000006317171245565959226487\n\nEPD\n\n",
    /* 02-it */ "SPC\n0200\n1\nCH6631996000002544373\nK\nFondazione Mondo Migliore\nCasella postale\n3001 Berna\n\n\nCH\n\n\n\n"
              + "\n\n\n\n\nCHF\n\n\n\n\n\n\n\nQRR\n000006317171245565959226487\n\nEPD\n\n",
    /* 05-de */ "SPC\n0200\n1\nCH2231989000007611146\nS\nKrankenkasse fit&munter\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n\n\n1"
              + "21.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nQRR\n000003701588132583136809972\nMonatsprämie "
              + "Juli 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:9.30/40/0:30\neB"
              + "ill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 05-en */ "SPC\n0200\n1\nCH2231989000007611146\nS\nHealth insurance fit&kicking\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n"
              + "\n\n121.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nQRR\n000003701588132583136809972\nPremium "
              + "calculation July 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:9.30"
              + "/40/0:30\neBill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 05-fr */ "SPC\n0200\n1\nCH2231989000007611146\nS\nCompagnie d'assurance forme&alerte\nAm Wasser\n1\n3000\nBerne\nCH\n\n"
              + "\n\n\n\n\n\n121.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThoune\nCH\nQRR\n000003701588132583136809972"
              + "\nPrime mensuelle juillet 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33"
              + "/7.7:9.30/40/0:30\neBill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 05-it */ "SPC\n0200\n1\nCH2231989000007611146\nS\nCompagnia di assicurazione forma&scalciante\nAm Wasser\n1\n3000\nBerna"
              + "\nCH\n\n\n\n\n\n\n\n121.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nQRR\n000003701588132583136"
              + "809972\nPremio mensile luglio 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7."
              + "7/33/7.7:9.30/40/0:30\neBill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 06-de */ "SPC\n0200\n1\nCH4831988000006669440\nK\nStiftung Bessere Welt\nPostfach\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nQRR\n000008639361539912849842165\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/10267383"
              + "1/31/200630\neBill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 06-en */ "SPC\n0200\n1\nCH4831988000006669440\nK\nBetter World Foundation\nPO Box\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nQRR\n000008639361539912849842165\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/10267383"
              + "1/31/200630\neBill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 06-fr */ "SPC\n0200\n1\nCH4831988000006669440\nK\nFondation monde meilleur\nCase postale\n3001 Berne\n\n\nCH\n\n\n\n\n\n"
              + "\n\n\nCHF\n\n\n\n\n\n\n\nQRR\n000008639361539912849842165\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/"
              + "102673831/31/200630\neBill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 06-it */ "SPC\n0200\n1\nCH4831988000006669440\nK\nFondazione Mondo Migliore\nCasella postale\n3001 Berna\n\n\nCH\n\n\n\n"
              + "\n\n\n\n\nCHF\n\n\n\n\n\n\n\nQRR\n000008639361539912849842165\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53"
              + "/30/102673831/31/200630\neBill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 13-de */ "SPC\n0200\n1\nCH7331955000007324129\nS\nKrankenkasse fit&munter\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n\n\n1"
              + "41.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nQRR\n000003983456426900478123999\nMonatsprämie "
              + "Juli 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:10.85/40/0:30\n\n",
    /* 13-en */ "SPC\n0200\n1\nCH7331955000007324129\nS\nHealth insurance fit&kicking\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n"
              + "\n\n141.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nQRR\n000003983456426900478123999\nPremium "
              + "calculation July 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:10.8"
              + "5/40/0:30\n\n",
    /* 13-fr */ "SPC\n0200\n1\nCH7331955000007324129\nS\nCompagnie d'assurance forme&alerte\nAm Wasser\n1\n3000\nBerne\nCH\n\n"
              + "\n\n\n\n\n\n141.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThoune\nCH\nQRR\n000003983456426900478123999"
              + "\nPrime mensuelle juillet 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33"
              + "/7.7:10.85/40/0:30\n\n",
    /* 13-it */ "SPC\n0200\n1\nCH7331955000007324129\nS\nCompagnia di assicurazione forma&scalciante\nAm Wasser\n1\n3000\nBerna"
              + "\nCH\n\n\n\n\n\n\n\n141.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nQRR\n000003983456426900478"
              + "123999\nPremio mensile luglio 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7."
              + "7/33/7.7:10.85/40/0:30\n\n",
    /* 14-de */ "SPC\n0200\n1\nCH2031975000007781535\nK\nStiftung Bessere Welt\nPostfach\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nQRR\n000009003770120603761188776\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/10267383"
              + "1/31/200630\n\n",
    /* 14-en */ "SPC\n0200\n1\nCH2031975000007781535\nK\nBetter World Foundation\nPO Box\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nQRR\n000009003770120603761188776\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/10267383"
              + "1/31/200630\n\n",
    /* 14-fr */ "SPC\n0200\n1\nCH2031975000007781535\nK\nFondation monde meilleur\nCase postale\n3001 Berne\n\n\nCH\n\n\n\n\n\n"
              + "\n\n\nCHF\n\n\n\n\n\n\n\nQRR\n000009003770120603761188776\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/"
              + "102673831/31/200630\n\n",
    /* 14-it */ "SPC\n0200\n1\nCH2031975000007781535\nK\nFondazione Mondo Migliore\nCasella postale\n3001 Berna\n\n\nCH\n\n\n\n"
              + "\n\n\n\n\nCHF\n\n\n\n\n\n\n\nQRR\n000009003770120603761188776\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53"
              + "/30/102673831/31/200630\n\n",
    /* 17-de */ "SPC\n0200\n1\nCH5800791123000889012\nS\nKrankenkasse fit&munter\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n\n\n2"
              + "11.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nSCOR\nRF240191230100405JSH0438\nMonatsprämie Ju"
              + "li 2020\nEPD\n\n",
    /* 17-en */ "SPC\n0200\n1\nCH5800791123000889012\nS\nHealth insurance fit&kicking\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n"
              + "\n\n211.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nSCOR\nRF240191230100405JSH0438\nPremium ca"
              + "lculation July 2020\nEPD\n\n",
    /* 17-fr */ "SPC\n0200\n1\nCH5800791123000889012\nS\nCompagnie d'assurance forme&alerte\nAm Wasser\n1\n3000\nBerne\nCH\n\n"
              + "\n\n\n\n\n\n211.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThoune\nCH\nSCOR\nRF240191230100405JSH0438\n"
              + "Prime mensuelle juillet 2020\nEPD\n\n",
    /* 17-it */ "SPC\n0200\n1\nCH5800791123000889012\nS\nCompagnia di assicurazione forma&scalciante\nAm Wasser\n1\n3000\nBerna"
              + "\nCH\n\n\n\n\n\n\n\n211.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nSCOR\nRF240191230100405JSH"
              + "0438\nPremio mensile luglio 2020\nEPD\n\n",
    /* 18-de */ "SPC\n0200\n1\nCH5204835012345671000\nK\nStiftung Bessere Welt\nPostfach\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nSCOR\nRF8420191230100503QYP0627\n\nEPD\n\n",
    /* 18-en */ "SPC\n0200\n1\nCH5204835012345671000\nK\nBetter World Foundation\nPO Box\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nSCOR\nRF8420191230100503QYP0627\n\nEPD\n\n",
    /* 18-fr */ "SPC\n0200\n1\nCH5204835012345671000\nK\nFondation monde meilleur\nCase postale\n3001 Berne\n\n\nCH\n\n\n\n\n\n"
              + "\n\n\nCHF\n\n\n\n\n\n\n\nSCOR\nRF8420191230100503QYP0627\n\nEPD\n\n",
    /* 18-it */ "SPC\n0200\n1\nCH5204835012345671000\nK\nFondazione Mondo Migliore\nCasella postale\n3001 Berna\n\n\nCH\n\n\n\n"
              + "\n\n\n\n\nCHF\n\n\n\n\n\n\n\nSCOR\nRF8420191230100503QYP0627\n\nEPD\n\n",
    /* 21-de */ "SPC\n0200\n1\nCH5800791123000889012\nS\nKrankenkasse fit&munter\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n\n\n2"
              + "21.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nSCOR\nRF7420191230100521UPV0857\nMonatsprämie J"
              + "uli 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:17.00/40/0:30\neB"
              + "ill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 21-en */ "SPC\n0200\n1\nCH5800791123000889012\nS\nHealth insurance fit&kicking\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n"
              + "\n\n221.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nSCOR\nRF7420191230100521UPV0857\nPremium c"
              + "alculation July 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:17.00"
              + "/40/0:30\neBill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 21-fr */ "SPC\n0200\n1\nCH5800791123000889012\nS\nCompagnie d'assurance forme&alerte\nAm Wasser\n1\n3000\nBerne\nCH\n\n"
              + "\n\n\n\n\n\n221.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThoune\nCH\nSCOR\nRF7420191230100521UPV0857"
              + "\nPrime mensuelle juillet 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33"
              + "/7.7:17.00/40/0:30\neBill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 21-it */ "SPC\n0200\n1\nCH5800791123000889012\nS\nCompagnia di assicurazione forma&scalciante\nAm Wasser\n1\n3000\nBerna"
              + "\nCH\n\n\n\n\n\n\n\n221.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nSCOR\nRF7420191230100521UP"
              + "V0857\nPremio mensile luglio 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7"
              + "/33/7.7:17.00/40/0:30\neBill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 22-de */ "SPC\n0200\n1\nCH5204835012345671000\nK\nStiftung Bessere Welt\nPostfach\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nSCOR\nRF9120191230100533PYZ0768\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831"
              + "/31/200630\neBill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 22-en */ "SPC\n0200\n1\nCH5204835012345671000\nK\nBetter World Foundation\nPO Box\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nSCOR\nRF9120191230100533PYZ0768\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831"
              + "/31/200630\neBill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 22-fr */ "SPC\n0200\n1\nCH5204835012345671000\nK\nFondation monde meilleur\nCase postale\n3001 Berne\n\n\nCH\n\n\n\n\n\n"
              + "\n\n\nCHF\n\n\n\n\n\n\n\nSCOR\nRF9120191230100533PYZ0768\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/1"
              + "02673831/31/200630\neBill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 22-it */ "SPC\n0200\n1\nCH5204835012345671000\nK\nFondazione Mondo Migliore\nCasella postale\n3001 Berna\n\n\nCH\n\n\n\n"
              + "\n\n\n\n\nCHF\n\n\n\n\n\n\n\nSCOR\nRF9120191230100533PYZ0768\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/"
              + "30/102673831/31/200630\neBill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 29-de */ "SPC\n0200\n1\nCH5800791123000889012\nS\nKrankenkasse fit&munter\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n\n\n2"
              + "41.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nSCOR\nRF8720191230100610TBL0982\nMonatsprämie J"
              + "uli 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:18.55/40/0:30\n\n",
    /* 29-en */ "SPC\n0200\n1\nCH5800791123000889012\nS\nHealth insurance fit&kicking\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n"
              + "\n\n241.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nSCOR\nRF8720191230100610TBL0982\nPremium c"
              + "alculation July 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:18.55"
              + "/40/0:30\n\n",
    /* 29-fr */ "SPC\n0200\n1\nCH5800791123000889012\nS\nCompagnie d'assurance forme&alerte\nAm Wasser\n1\n3000\nBerne\nCH\n\n"
              + "\n\n\n\n\n\n241.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThoune\nCH\nSCOR\nRF8720191230100610TBL0982"
              + "\nPrime mensuelle juillet 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33"
              + "/7.7:18.55/40/0:30\n\n",
    /* 29-it */ "SPC\n0200\n1\nCH5800791123000889012\nS\nCompagnia di assicurazione forma&scalciante\nAm Wasser\n1\n3000\nBerna"
              + "\nCH\n\n\n\n\n\n\n\n241.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nSCOR\nRF8720191230100610TB"
              + "L0982\nPremio mensile luglio 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7"
              + "/33/7.7:18.55/40/0:30\n\n",
    /* 30-de */ "SPC\n0200\n1\nCH5204835012345671000\nK\nStiftung Bessere Welt\nPostfach\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nSCOR\nRF4520191230100622HHM0593\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831"
              + "/31/200630\n\n",
    /* 30-en */ "SPC\n0200\n1\nCH5204835012345671000\nK\nBetter World Foundation\nPO Box\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nSCOR\nRF4520191230100622HHM0593\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831"
              + "/31/200630\n\n",
    /* 30-fr */ "SPC\n0200\n1\nCH5204835012345671000\nK\nFondation monde meilleur\nCase postale\n3001 Berne\n\n\nCH\n\n\n\n\n\n"
              + "\n\n\nCHF\n\n\n\n\n\n\n\nSCOR\nRF4520191230100622HHM0593\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/1"
              + "02673831/31/200630\n\n",
    /* 30-it */ "SPC\n0200\n1\nCH5204835012345671000\nK\nFondazione Mondo Migliore\nCasella postale\n3001 Berna\n\n\nCH\n\n\n\n"
              + "\n\n\n\n\nCHF\n\n\n\n\n\n\n\nSCOR\nRF4520191230100622HHM0593\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/"
              + "30/102673831/31/200630\n\n",
    /* 33-de */ "SPC\n0200\n1\nCH5800791123000889012\nS\nKrankenkasse fit&munter\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n\n\n3"
              + "11.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nNON\n\nMonatsprämie Juli 2020\nEPD\n\n",
    /* 33-en */ "SPC\n0200\n1\nCH5800791123000889012\nS\nHealth insurance fit&kicking\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n"
              + "\n\n311.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nNON\n\nPremium calculation July 2020\nEPD"
              + "\n\n",
    /* 33-fr */ "SPC\n0200\n1\nCH5800791123000889012\nS\nCompagnie d'assurance forme&alerte\nAm Wasser\n1\n3000\nBerne\nCH\n\n"
              + "\n\n\n\n\n\n311.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThoune\nCH\nNON\n\nPrime mensuelle juillet 2"
              + "020\nEPD\n\n",
    /* 33-it */ "SPC\n0200\n1\nCH5800791123000889012\nS\nCompagnia di assicurazione forma&scalciante\nAm Wasser\n1\n3000\nBerna"
              + "\nCH\n\n\n\n\n\n\n\n311.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nNON\n\nPremio mensile lugl"
              + "io 2020\nEPD\n\n",
    /* 34-de */ "SPC\n0200\n1\nCH5204835012345671000\nK\nStiftung Bessere Welt\nPostfach\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nNON\n\n\nEPD\n\n",
    /* 34-en */ "SPC\n0200\n1\nCH5204835012345671000\nK\nBetter World Foundation\nPO Box\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nNON\n\n\nEPD\n\n",
    /* 34-fr */ "SPC\n0200\n1\nCH5204835012345671000\nK\nFondation monde meilleur\nCase postale\n3001 Berne\n\n\nCH\n\n\n\n\n\n"
              + "\n\n\nCHF\n\n\n\n\n\n\n\nNON\n\n\nEPD\n\n",
    /* 34-it */ "SPC\n0200\n1\nCH5204835012345671000\nK\nFondazione Mondo Migliore\nCasella postale\n3001 Berna\n\n\nCH\n\n\n\n"
              + "\n\n\n\n\nCHF\n\n\n\n\n\n\n\nNON\n\n\nEPD\n\n",
    /* 37-de */ "SPC\n0200\n1\nCH5800791123000889012\nS\nKrankenkasse fit&munter\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n\n\n3"
              + "21.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nNON\n\nMonatsprämie Juli 2020\nEPD\n//S1/10/102"
              + "01409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:24.70/40/0:30\neBill/B/sarah.beispiel@einfa"
              + "ch-zahlen.ch\n\n",
    /* 37-en */ "SPC\n0200\n1\nCH5800791123000889012\nS\nHealth insurance fit&kicking\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n"
              + "\n\n321.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nNON\n\nPremium calculation July 2020\nEPD"
              + "\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:24.70/40/0:30\neBill/B/sarah.b"
              + "eispiel@einfach-zahlen.ch\n\n",
    /* 37-fr */ "SPC\n0200\n1\nCH5800791123000889012\nS\nCompagnie d'assurance forme&alerte\nAm Wasser\n1\n3000\nBerne\nCH\n\n"
              + "\n\n\n\n\n\n321.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThoune\nCH\nNON\n\nPrime mensuelle juillet 2"
              + "020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:24.70/40/0:30\neBill/B"
              + "/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 37-it */ "SPC\n0200\n1\nCH5800791123000889012\nS\nCompagnia di assicurazione forma&scalciante\nAm Wasser\n1\n3000\nBerna"
              + "\nCH\n\n\n\n\n\n\n\n321.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nNON\n\nPremio mensile lugl"
              + "io 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:24.70/40/0:30\neBi"
              + "ll/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 38-de */ "SPC\n0200\n1\nCH5204835012345671000\nK\nStiftung Bessere Welt\nPostfach\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nNON\n\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630\neBill/B/sarah."
              + "beispiel@einfach-zahlen.ch\n\n",
    /* 38-en */ "SPC\n0200\n1\nCH5204835012345671000\nK\nBetter World Foundation\nPO Box\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nNON\n\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630\neBill/B/sarah."
              + "beispiel@einfach-zahlen.ch\n\n",
    /* 38-fr */ "SPC\n0200\n1\nCH5204835012345671000\nK\nFondation monde meilleur\nCase postale\n3001 Berne\n\n\nCH\n\n\n\n\n\n"
              + "\n\n\nCHF\n\n\n\n\n\n\n\nNON\n\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630\neBill/"
              + "B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 38-it */ "SPC\n0200\n1\nCH5204835012345671000\nK\nFondazione Mondo Migliore\nCasella postale\n3001 Berna\n\n\nCH\n\n\n\n"
              + "\n\n\n\n\nCHF\n\n\n\n\n\n\n\nNON\n\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630\neB"
              + "ill/B/sarah.beispiel@einfach-zahlen.ch\n\n",
    /* 45-de */ "SPC\n0200\n1\nCH5800791123000889012\nS\nKrankenkasse fit&munter\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n\n\n3"
              + "41.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nNON\n\nMonatsprämie Juli 2020\nEPD\n//S1/10/102"
              + "01409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:26.25/40/0:30\n\n",
    /* 45-en */ "SPC\n0200\n1\nCH5800791123000889012\nS\nHealth insurance fit&kicking\nAm Wasser\n1\n3000\nBern\nCH\n\n\n\n\n\n"
              + "\n\n341.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nNON\n\nPremium calculation July 2020\nEPD"
              + "\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:26.25/40/0:30\n\n",
    /* 45-fr */ "SPC\n0200\n1\nCH5800791123000889012\nS\nCompagnie d'assurance forme&alerte\nAm Wasser\n1\n3000\nBerne\nCH\n\n"
              + "\n\n\n\n\n\n341.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThoune\nCH\nNON\n\nPrime mensuelle juillet 2"
              + "020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:26.25/40/0:30\n\n",
    /* 45-it */ "SPC\n0200\n1\nCH5800791123000889012\nS\nCompagnia di assicurazione forma&scalciante\nAm Wasser\n1\n3000\nBerna"
              + "\nCH\n\n\n\n\n\n\n\n341.00\nCHF\nS\nSarah Beispiel\nMustergasse\n1\n3600\nThun\nCH\nNON\n\nPremio mensile lugl"
              + "io 2020\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630/32/7.7/33/7.7:26.25/40/0:30\n\n",
    /* 46-de */ "SPC\n0200\n1\nCH5204835012345671000\nK\nStiftung Bessere Welt\nPostfach\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nNON\n\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630\n\n",
    /* 46-en */ "SPC\n0200\n1\nCH5204835012345671000\nK\nBetter World Foundation\nPO Box\n3001 Bern\n\n\nCH\n\n\n\n\n\n\n\n\nCH"
              + "F\n\n\n\n\n\n\n\nNON\n\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630\n\n",
    /* 46-fr */ "SPC\n0200\n1\nCH5204835012345671000\nK\nFondation monde meilleur\nCase postale\n3001 Berne\n\n\nCH\n\n\n\n\n\n"
              + "\n\n\nCHF\n\n\n\n\n\n\n\nNON\n\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630\n\n",
    /* 46-it */ "SPC\n0200\n1\nCH5204835012345671000\nK\nFondazione Mondo Migliore\nCasella postale\n3001 Berna\n\n\nCH\n\n\n\n"
              + "\n\n\n\n\nCHF\n\n\n\n\n\n\n\nNON\n\n\nEPD\n//S1/10/10201409/11/200630/20/140.000-53/30/102673831/31/200630\n\n"
]


</script>

<Card class="mb-3">
  <CardHeader>
    <CardTitle>
      <Icon name="file-code" /> Options
    </CardTitle>
  </CardHeader>
  <CardBody>

    <Row>
      <Col class="text-end">
        <Button on:click={reset} color=secondary>Nouveau scan</Button>
      </Col>
    </Row>

    <Row>
      <Col>
        <FormGroup class="form-floating">

          <p class="lead">Traitements automatiques</p>

          <Input type="checkbox" bind:checked={$rc.prefs.auto_location}
            label="Auto-détection du NPA et du lieu à partir de l'adresse #2 (pour les adresses suisses uniquement)"/>

          <Input type="checkbox" bind:checked={$rc.prefs.auto_reference}
            label="Auto-détection de la référence de la facture à partir de la référence QRR (si elle existe)" />

          <p class="lead mt-3">Interface utilisateur</p>

          <Input type="checkbox" bind:checked={$rc.prefs.show_splits}
            label="Autoriser la ventilation du montant part compte et/ou mandat"/>

          <Input type="checkbox" bind:checked={$rc.prefs.editable}
            label="Autoriser la modification des données QR code (excepté le montant, la devise et l'IBAN du bénéficiaire)"/>

          <Input type="checkbox" bind:checked={$rc.prefs.use_ucreditor}
            label="Autoriser la saisie du bénéficiaire final"/>
            {#if $rc.prefs.use_ucreditor}
              <Input type="checkbox" class="mx-4" bind:checked={$rc.prefs.use_ucrediban}
                label="Autoriser la saisie d'un IBAN pour le bénéficiaire final"/>
            {/if}

          <Input type="checkbox" bind:checked={$rc.prefs.show_debtor}
            label="Afficher les données relatives au débiteur"/>

          <p class="lead mt-3">Mode expert</p>

          <Input type="checkbox" bind:checked={$rc.prefs.show_json}
            label="Afficher les données saisies (transmises à SAMinfo)"/>
            {#if $rc.prefs.show_json}
              <Input type="checkbox" class="mx-4" bind:checked={$rc.prefs.show_sqlcmd}
                label="Afficher la commande SQL de mise à jour de SAMinfo"/>
              <Input type="checkbox" class="mx-4" bind:checked={$rc.prefs.show_sqlmap}
                label="Afficher la relation champ SQL/JSON"/>
            {/if}

          <Input type="checkbox" bind:checked={$rc.prefs.show_qrdata}
            label="Afficher les données brutes du QR code"/>
            {#if $rc.prefs.show_qrdata}
             <Input type="checkbox" class="mx-4" bind:checked={$rc.prefs.use_samples}
               label="Utiliser les échantillons de test"/>
             <Input type="checkbox" class="mx-4" bind:checked={$rc.prefs.edit_qrdata}
               label="Autoriser la modification des données brutes"/>
            {/if}

        </FormGroup>
      </Col>
    </Row>
  </CardBody>

  {#if $rc.prefs.show_json}
    <CardHeader>
      <CardTitle>
        <Icon name="file-code" /> Données saisies
      </CardTitle>
    </CardHeader>
    <CardBody>
      {#if $rc.prefs.show_sqlcmd}
        <Row>
          <Col>
            <pre>{sqlcommand}</pre>
          </Col>
        </Row>
      {/if}
      {#if $rc.prefs.show_sqlmap}
        <Row>
          <Col>
            <table class="table table-striped">
              <thead>
                <tr valign="top">
                  <th>Variable SQL</th>
                  <th>Champ JSON</th>
                  <th>Valeur</th>
                </tr>
              </thead>
              <tbody>

                <tr valign="top">
                  <td><tt>BVR_Type</tt></td>
                  <td>Codé en dur</td>
                  <td>QR</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_Date</tt></td>
                  <td><code>qrbill.payment.date</code></td>
                  <td>{$qrbill.payment.date}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_DelaiPaiement</tt></td>
                  <td><code>qrbill.payment.delay</code></td>
                  <td>{$qrbill.payment.delay}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_DateEcheance</tt></td>
                  <td><code>qrbill.payment.duedate</code></td>
                  <td>{$qrbill.payment.duedate}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_MontantHT</tt></td>
                  <td><code>qrbill.payment.amount</code><br />
                      <code>qrbill.payment.vatcode</code></td>
                  <td><b>TODO</b> Calculer à partir de
                      <tt>BVR_MontantOriginal</tt>  (<b>{$qrbill.payment.amount}</b>) et de
                      <tt>BVR_CodeCategorieTVA</tt> (<b>{$qrbill.payment.vatcode}</b>)
                      <br><span class="text-secondary">Ne peux pas être calculé sur le poste client car on ne récupère pas,
                      pour l'instant, les taux de TVA.</span></td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_MontantTTC</tt></td>
                  <td><code>qrbill.payment.amount</code><br />
                      <code>qrbill.payment.currency</code></td>
                  <td><b>TODO</b> Calculer à partir de
                      <tt>BVR_MontantOriginal</tt>  (<b>{$qrbill.payment.amount}</b>) et de
                      <tt>BVR_NoMonnaie</tt> (<b>{$qrbill.payment.currency}</b>)
                      <br><span class="text-secondary">Ne peux pas être calculé sur le poste client car on ne récupère pas,
                      pour l'instant, les taux de change.</span></td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_MontantOriginal</tt></td>
                  <td><code>qrbill.payment.amount</code></td>
                  <td>{$qrbill.payment.amount} <span class="text-secondary">(dans la devise du QRcode)</span></td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_TVAMontant</tt></td>
                  <td><code>qrbill.payment.amount</code><br />
                      <code>qrbill.payment.vatcode</code></td>
                  <td><b>TODO</b> Calculer à partir de
                      <tt>BVR_MontantOriginal</tt>  (<b>{$qrbill.payment.amount}</b>) et de
                      <tt>BVR_CodeCategorieTVA</tt> (<b>{$qrbill.payment.vatcode}</b>)
                      <br><span class="text-secondary">Ne peux pas être calculé sur le poste client car on ne récupère pas,
                      pour l'instant, les taux de TVA.</span></td>
                </tr>
                <tr valign="top">
                  <td><tt>BVR_TVATaux</tt></td>
                  <td><code>qrbill.payment.vatcode</code></td>
                  <td><b>TODO</b> Calculer à partir de
                      <tt>BVR_CodeCategorieTVA</tt> (<b>{$qrbill.payment.vatcode}</b>)
                      <br><span class="text-secondary">Donnée non rapatriée sur le poste client, pour l'instant.</span></td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_CodeCategorieTVA</tt></td>
                  <td><code>qrbill.payment.vatcode</code></td>
                  <td>{$qrbill.payment.vatcode}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_NoMonnaie</tt></td>
                  <td><code>qrbill.payment.currency</code></td>
                  <td><b>SQL</b> SELECT NoMonnaie WHERE MON_LibelleCourt = `<b>{$qrbill.payment.currency}</b>`)</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_NoCompte</tt></td>
                  <td><code>qrbill.payment.account</code></td>
                  <td>{$qrbill.payment.account}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BV_NoCompteCCP</tt></td>
                  <td><code>qrbill.creditor.iban</code></td>
                  <td><b>SQL</b> RIGHT(`<b>{$qrbill.creditor.iban}</b>`, 10)</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_NoCompteBanque</tt></td>
                  <td><code></code></td>
                  <td></td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_NoRef</tt></td>
                  <td><code>qrbill.payment.billid</code></td>
                  <td>{$qrbill.payment.billid}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_Code</tt></td>
                  <td><code>qrbill.payment.billid</code></td>
                  <td>{$qrbill.payment.billid}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_Motif</tt></td>
                  <td>{$qrbill.payment.billinfo}</td>
                  <td>{$qrbill.payment.billinfo}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_EnFaveurDeChamp1</tt></td>
                  <td><code>qrbill.creditor.iban</code></td>
                  <td><b>SQL</b> RIGHT('<b>{$qrbill.creditor.iban}</b>', 10)</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_NoEntreprise</tt></td>
                  <td><code>qrbill.creditor.id</code></td>
                  <td>{$qrbill.creditor.id}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_NoContact</tt></td>
                  <td><code>qrbill.payment.account</code></td>
                  <td>{$qrbill.payment.account}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_NoProjet</tt></td>
                  <td><code>qrbill.payment.order</code></td>
                  <td>{$qrbill.payment.order}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_NoDocument</tt></td>
                  <td><code></code></td>
                  <td></td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_EnFaveurDeChamp2</tt></td>
                  <td><code>qrbill.creditor.name</code></td>
                  <td>{$qrbill.creditor.name}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_EnFaveurDeChamp3</tt></td>
                  <td><code>qrbill.creditor.addr1</code></td>
                  <td>{$qrbill.creditor.addr1}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_EnFaveurDeChamp4</tt></td>
                  <td><code>qrbill.creditor.addr2</code></td>
                  <td>{$qrbill.creditor.addr2}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_EnFaveurDeChamp5</tt></td>
                  <td><code>qrbill.creditor.postcode</code></td>
                  <td>{$qrbill.creditor.postcode}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_EnFaveurDeChamp6</tt></td>
                  <td><code>qrbill.creditor.location</code></td>
                  <td>{$qrbill.creditor.location}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_VersementPourChamp1</tt></td>
                  <td><code>qrbill.creditor.name</code></td>
                  <td>{$qrbill.creditor.name}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_VersementPourChamp2</tt></td>
                  <td><code>qrbill.creditor.addr1</code></td>
                  <td>{$qrbill.creditor.addr1}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_VersementPourChamp3</tt></td>
                  <td><code>qrbill.creditor.postcode</code></td>
                  <td>{$qrbill.creditor.postcode}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_VersementPourChamp4</tt></td>
                  <td><code>qrbill.creditor.location</code></td>
                  <td>{$qrbill.creditor.location}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_NoIBAN</tt></td>
                  <td><code>qrbill.creditor.iban</code></td>
                  <td>{$qrbill.creditor.iban}</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_NoClearing</tt></td>
                  <td><code>qrbill.creditor.iban</code></td>
                  <td><b>SQL</b> TRIM(LEADING '0' FROM SUBSTRING('<b>{$qrbill.creditor.iban}</b>', 5, 9))</td>
                </tr>

                <tr valign="top">
                  <td><tt>BVR_QRJson</tt></td>
                  <td><code>qrbill.data</code></td>
                  <td>{$qrbill.data}</td>
                </tr>

              </tbody>
            </table>
          </Col>
        </Row>
      {:else}
        <Row>

          <Col class="col-12 col-md-4">
            <p class="lead">Paiement</p>
            <pre>{JSON.stringify($qrbill.payment, null, 2)}</pre>
          </Col>

          <Col class="col-12 col-md-4">
            <p class="lead">Bénéficiaire</p>
            <pre>{JSON.stringify($qrbill.creditor, null, 2)}</pre>
          </Col>

          {#if $rc.prefs.use_ucreditor}
            <Col class="col-12 col-md-4">
              <p class="lead">Bénéficiaire final</p>
              <pre>{JSON.stringify($qrbill.ucreditor, null, 2)}</pre>
            </Col>
          {/if}

          {#if $rc.prefs.show_debtor}
            <Col class="col-12 col-md-4">
              <p class="lead">Débiteur</p>
              <pre>{JSON.stringify($qrbill.debtor, null, 2)}</pre>
            </Col>
          {/if}

          {#if $qrbill.payment.splitaccounts}
            <Col class="col-12 col-md-4">
              <p class="lead">Ventilation par compte</p>
              <pre>{JSON.stringify($qrbill.accounts, null, 2)}</pre>
            </Col>
          {/if}

          {#if $qrbill.payment.splitorders}
            <Col class="col-12 col-md-4">
              <p class="lead">Ventilation par mandats</p>
              <pre>{JSON.stringify($qrbill.orders, null, 2)}</pre>
            </Col>
          {/if}

        </Row>
      {/if}
    </CardBody>
  {/if}

  {#if $rc.prefs.show_qrdata}
    <CardHeader>
      <CardTitle>
        <Icon name="file-code" /> Données brutes
      </CardTitle>
    </CardHeader>
    <CardBody>
      {#if $rc.prefs.use_samples}
        <Row>
          <Col class="col-12">
            <FormGroup>
              <Label for="qrdata-sampler">Echantillon de test
                {#if sample_id == 0}
                  (Faites glisser le curseur pour sélectionner un échantillon)
                {:else}
                  <Badge color=secondary>{sample_id}</Badge>
                {/if}
              </Label>
              <Input type="range" name="range" id="qrdata-sampler" min=0 max=72 step=1 bind:value={sample_id}
                on:change={use_sample} placeholder="QRdata sampler" />
              </FormGroup>
          </Col>
        </Row>
      {/if}
      <Row>
        <Col class="col-12">
          <FormGroup class="form-floating">
             <Input id="qrdata" type="textarea" on:change={qrupdate} style="height: 300px" bind:value={$qrbill.data}
               placeholder="Données brutes du dernier QR code scanée" readonly={!$rc.prefs.edit_qrdata} />
             <Label class={$rc.prefs.edit_qrdata ? '' : 'form-control-plaintext'} for="qrdata">QRCode data</Label>
           </FormGroup>
        </Col>
      </Row>
    </CardBody>
  {/if}

</Card>
