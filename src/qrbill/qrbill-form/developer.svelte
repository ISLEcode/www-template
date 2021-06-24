<script lang="ts">
import { Icon, Col, Container, Row } from 'sveltestrap5';
import { Badge, Button, Form, FormGroup, FormText, Input, Label } from 'sveltestrap5';
import { Card, CardBody, CardFooter, CardHeader, CardSubtitle, CardText, CardTitle } from 'sveltestrap5';
import { qrbill } from '../store/qrbills';
import { qrdata2array, qrbill2ary, qrbill2sql  } from '../../lib/stdlib/qrbill';
import rc from '../prefs';

let input;
$: input = qrbill2ary ($qrbill, $rc)

function qrupdate   () { qrdata2array ($qrbill.data, $qrbill, $rc.prefs) }

function reset () {
    $qrbill.data = null
    if (!$rc.prefs.use_samples) return
    $rc.prefs.use_samples = false
//    location.reload()
}

let sqlcommand; $: sqlcommand = qrbill2sql ($qrbill, $rc.prefs)

function use_sample () {
    $qrbill.data = samples[sample_id]
    if (sample_id > 0) qrupdate ()
}
let sample_id = 0
let samples = [
    /* none  */ null,
    /* pm-01 */ "SPC\n0200\n1\nCH9330000001800100053\nS\nSanitas Grundversicherungen AG\nSanitas Hauptsitz\n\n8004\nZürich\nCH\n\n\n\n\n\n\n\n75.70\nCHF\nS\nPatrick Mamin\nSous le Chêne\n16A\n2043\nBoudevilliers\nCH\nQRR\n101628244324001203697800006\nFacture de primes 1628244324 27.05.2021 / Numéro de client 12.03697-8\nEPD\n\n",
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
            label="Renseigner la référence de la facture à partir des informations supplémentaires (si elles existent)" />

          <p class="lead mt-3">Interface utilisateur</p>

          <Input type="checkbox" bind:checked={$rc.prefs.auto_hidesupplier}
            label="N'afficher le libellé et les mots clés que pour la saisie d'un nouveau fournisseur"/>

          <Input type="checkbox" bind:checked={$rc.prefs.edit_amount}
            label="Autoriser la modification du montant du mandat"/>

          <Input type="checkbox" bind:checked={$rc.prefs.show_splits}
            label="Autoriser la ventilation du montant part compte et/ou mandat"/>

          <Input type="checkbox" bind:checked={$rc.prefs.editable}
            label="Autoriser la modification des données QR code (excepté le montant, la devise et l'IBAN du bénéficiaire)"/>

          <Input type="checkbox" bind:checked={$rc.prefs.show_creditor}
            label="Afficher les données relatives au bénéficiaire"/>

            {#if $rc.prefs.show_creditor}
              <Input type="checkbox" class="mx-4" bind:checked={$rc.prefs.use_ucreditor}
                label="Autoriser la saisie du bénéficiaire final"/>
              {#if $rc.prefs.use_ucreditor}
                <Input type="checkbox" class="mx-4" bind:checked={$rc.prefs.use_ucrediban}
                  label="Autoriser la saisie d'un IBAN pour le bénéficiaire final"/>
              {/if}
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

                <tr>
                  <td><tt>qrr_typeqrcode</tt></td>
                  <td><tt>bill_kind</tt></td>
                  <td>{input['bill_kind']}</td>
                </tr>

                <tr>
                  <td><tt>qrr_nodocument</tt></td>
                  <td><tt>bill_id</tt></td>
                  <td>{input['bill_id']}</td>
                </tr>

                <tr>
                  <td><tt>qrr_motif</tt></td>
                  <td><tt>bill_subject</tt></td>
                  <td>{input['bill_subject']}</td>
                </tr>

                <tr>
                  <td><tt>qrr_reference</tt></td>
                  <td><tt>bill_reference</tt></td>
                  <td>{input['bill_reference']}</td>
                </tr>

                <tr>
                  <td><tt>qrr_noprojet</tt></td>
                  <td><tt>bill_order</tt></td>
                  <td>{input['bill_order']}</td>
                </tr>

                <tr>
                  <td><tt>qrr_nocompte</tt></td>
                  <td><tt>bill_account</tt></td>
                  <td>{input['bill_account']}</td>
                </tr>

                <tr>
                  <td><tt>qrr_montantoriginal</tt></td>
                  <td><tt>bill_amount</tt></td>
                  <td>{input['bill_amount']}</td>
                </tr>

                <tr>
                  <td><tt>qrr_codemonnaie</tt></td>
                  <td><tt>bill_currency</tt></td>
                  <td>{input['bill_currency']}</td>
                </tr>

                <tr>
                  <td><tt>qrr_nocategorietva</tt></td>
                  <td><tt>bill_vatcode</tt></td>
                  <td>{input['bill_vatcode']}</td>
                </tr>

                <tr>
                  <td><tt>qrr_date</tt></td>
                  <td><tt>bill_date</tt></td>
                  <td>{input['bill_date']}</td>
                </tr>

                <tr>
                  <td><tt>qrr_delai</tt></td>
                  <td><tt>bill_delay</tt></td>
                  <td>{input['bill_delay']}</td>
                </tr>

                <tr>
                  <td><tt>qrr_dateecheance</tt></td>
                  <td><tt>bill_duedate</tt></td>
                  <td>{input['bill_duedate']}</td>
                </tr>

                <tr>
                  <td><tt>qrr_data</tt></td>
                  <td><tt>bill_rawdata</tt></td>
                  <td>{input['bill_rawdata']}</td>
                </tr>


                <tr>
                  <td><tt>fournisseur_id</tt></td>
                  <td><tt>creditor_id</tt></td>
                  <td>{input['creditor_id']}</td>
                </tr>

                <tr>
                  <td><tt>fournisseur_maj</tt></td>
                  <td><tt>creditor_update</tt></td>
                  <td>{input['creditor_update']}</td>
                </tr>

                <tr>
                  <td><tt>fournisseur_nom</tt></td>
                  <td><tt>creditor_name</tt></td>
                  <td>{input['creditor_name']}</td>
                </tr>

                <tr>
                  <td><tt>fournisseur_label</tt></td>
                  <td><tt>creditor_label</tt></td>
                  <td>{input['creditor_label']}</td>
                </tr>

                <tr>
                  <td><tt>fournisseur_motcle</tt></td>
                  <td><tt>creditor_suffix</tt></td>
                  <td>{input['creditor_suffix']}</td>
                </tr>

                <tr>
                  <td><tt>fournisseur_contact</tt></td>
                  <td><tt>creditor_contact</tt></td>
                  <td>{input['creditor_contact']}</td>
                </tr>

                <tr>
                  <td><tt>fournisseur_iban</tt></td>
                  <td><tt>creditor_iban</tt></td>
                  <td>{input['creditor_iban']}</td>
                </tr>

                <tr>
                  <td><tt>fournisseur_ledger</tt></td>
                  <td><tt>creditor_ledger</tt></td>
                  <td>{input['creditor_ledger']}</td>
                </tr>

                <tr>
                  <td><tt>fournisseur_addr1</tt></td>
                  <td><tt>creditor_addr1</tt></td>
                  <td>{input['creditor_addr1']}</td>
                </tr>

                <tr>
                  <td><tt>fournisseur_addr2</tt></td>
                  <td><tt>creditor_addr2</tt></td>
                  <td>{input['creditor_addr2']}</td>
                </tr>

                <tr>
                  <td><tt>fournisseur_lieu</tt></td>
                  <td><tt>creditor_location</tt></td>
                  <td>{input['creditor_location']}</td>
                </tr>

                <tr>
                  <td><tt>fournisseur_npa</tt></td>
                  <td><tt>creditor_postcode</tt></td>
                  <td>{input['creditor_postcode']}</td>
                </tr>

                <tr>
                  <td><tt>fournisseur_pays</tt></td>
                  <td><tt>creditor_country</tt></td>
                  <td>{input['creditor_country']}</td>
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
