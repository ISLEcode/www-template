---
# vim: nu et tw=130 ts=8 sts=4 sw=4 ff=unix fo-=l fo+=tcroq2 fdm=marker fmr=@{,@} spell spelllang=fr
title       : Bulletin de versement orange (BVR) – standard pour l'envoi de factures
revision    : Wed Dec 06, 2017 11:40:03
---

### Introduction

Avec le bulletin de versement orange pour les émetteurs de factures (BVR), la facturation et les encaissements sont largement
automatisés. Le numéro de référence imprimé permet une facturation simple et sûre en francs suisses.

**Quels sont les avantages du bulletin de versement orange?**

-   Simple -- La facturation s'effectue à partir de la comptabilité débiteurs, ce qui simplifie également les procédures du
    contentieux.

-   Efficace -- Grâce au numéro de référence, vous pouvez automatiser le recoupement des entrées de paiement avec votre
    comptabilité débiteurs.

-   Reconnue -- L'interface SBVR nécessaire existe aujourd'hui dans tout logiciel de comptabilité disponible dans le commerce.

-   Réduits -- Pour les versements au guichet de la poste, vous payez moins de frais avec les BVR qu'avec les bulletins de
    versement rouges.

Si vous ne disposez pas d'un logiciel comptable, vous pouvez également commander les bulletins de versement orange auprès de votre
banque. Une synchronisation automatisée des entrées de paiement et de votre comptabilité n'est toutefois pas possible dans ce
cas.

**Comment fonctionne la facturation avec le bulletin de versement orange?**

Vous créez le bulletin de versement orange comportant le numéro de référence (BVR) avec la facture dans votre logiciel de
comptabilité. La facture est envoyée soit physiquement soit électroniquement avec l'e-facture. Un poste non soldé est ainsi créé
pour chaque facture dans votre comptabilité débiteurs. Si la facture est payée et que le montant de la facture est crédité sur
votre compte, les informations BVR sur ce crédit vous sont fournies dans l'e-banking ou dans votre logiciel de comptabilité par
l'intermédiaire d'une interface. Lorsque vous avez lu ces informations, votre logiciel de comptabilité peut attribuer le montant
qui a été crédité à l'aide du numéro de référence (se composant du numéro d'identification BVR, du n° de facture et du chiffre de
contrôle) aux postes encore ouverts correspondants et le recouper automatiquement.Vous économisez ainsi du temps et de l'argent.

Quels sont les conditions pour le bulletin de versement orange?

-   Un compte courant ou un compte d'association.
-   Le numéro de participant BVR de votre banque et un numéro d'identification BVR, disponible dans votre Banque
-   Accès à l'e-banking ou interface directe vers votre banque pour le téléchargement des informations BVR de crédit.
-   Logiciel de comptabilité avec module des débiteurs pour le traitement automatique des informations BVR de crédit.

Si vous ne disposez pas d'un logiciel comptable, vous pouvez également commander les bulletins de versement orange auprès de votre
Banque. Une synchronisation automatisée des entrées de paiement et de votre comptabilité n'est toutefois pas possible dans ce
cas.

**A qui s'adresse le bulletin de versement orange?**

Le bulletin de versement orange est surtout approprié pour les entreprises qui disposent d'un logiciel comptable compatible avec
les BVR. Elle permet une automatisation permanente de votre comptabilité.

**Harmonisation du trafic des paiements suisse

Le bulletin de versement orange devrait être remplacé par le nouveau bulletin de versement avec code QR entre mi-2018 et fin
2018.Retrouvez ici toutes les informations sur l'harmonisation.

### Présentation

![Bulletin de versement orange (BVR)](../zip/images/bvr-qr.png)

Modèle de présentation pour l'impression des bulletins de versement oranges (BVR)

1.  Numéro d'identification BVR du client

    Le numéro vous identifie en tant qu'émetteur de la facture et doit être saisi dans la configuration de votre logiciel de
    comptabilité. La longueur dépend des paramètres de votre logiciel et est en général de 6 chiffres. Le numéro est généralement
    positionné au tout début du numéro de référence.

2.  Numéro de facture (la longueur varie en fonction de la longueur de l'ID BVR)

    Vous pouvez utiliser cette partie du numéro de référence (à 20 chiffres dans l'exemple) afin d'identifier les débiteurs. Votre
    logiciel de facturation vous donne la structure des numéros de facture (par exemple se composant des numéros des clients et
    des factures). Les positions non utilisées sont indiquées par des zéros.

3.  Numéro de participant BVR

    La banque est identifiée à l'aide de ce numéro. Dans la ligne de codage de la partie inférieure du justificatif, le
    justificatif doit comporter 9 chiffres. La partie centrale comporte 5 chiffres et est complétée avec des zéros si nécessaire.
    Dans notre exemple avec un zéro devant (01-052142-5).

4.  Montant (à 10 chiffres) plus valeurs fixes

    Le montant est présenté avec 10 chiffres. Les positions non utilisées sont indiquées par des zéros.

5.  Chiffre de contrôle (est généré par votre logiciel)

