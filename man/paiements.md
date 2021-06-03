Terminologie
------------------------

SBVR
:   Système de bulletin de versement orange avec numéro de référence, permet une automatisation poussée de la facturation.

BVR
:   Bulletin de versement avec numéro de référence.

BVR+
:   Bulletin de versement avec numéro de référence sans montant préimprimé.

BVRB
:   Bulletin de versement avec référence bancaire

BVRB+
:   Bulletin de versement avec référence bancaire sans montant préimprimé.

Ligne de codage
:   La ligne de codage se trouve dans la zone de codage blanche dans la marge inférieure du BVR/BVRB. La zone de codage englobe
    les lignes 20 à 25. Sur le BVR/BVRB, l'inscription de la ligne de codage est prévue à la ligne 21.

À cases
:   Le montant peut être imprimé directement par PC ou rempli à la main

    ![](paiements/geboxt.png)

À cadres
:   Le montant doit être imprimé par PC

    ![](paiements/gerahmt.png)

Identification
:   Pour l'identification automatisée d'un client bancaire, la ligne de codage doit contenir, outre le numéro d'adhérent de la
    banque en question, un numéro d'identification BVRB à 6 positions. Celui-ci vous est attribué par la banque.

    Postfinance : pour le traitement automatisé des BVR, un numéro de client BVR est attribué au client.

OCR-B
:   Police standardisée lisible par ordinateur qui doit obligatoirement être utilisée pour la ligne de codage.

Dénomination de l'adhérent
:   Désigne l'adhérent au système SBVR aux yeux de Postfinance. Sur un BVRB, il s'agit toujours et dans tous les cas de votre
    banque. Sur les BVRB/ BVRB+, il est inscrit après "Versement pour". L'adhérent est suivi de l'adresse du client de la banque
    ("En faveur de"). La dénomination d'adhérent figurant sur le BVR/BVR+ doit permettre au débiteur (payeur) et aux instances de
    traitement d'identifier sans équivoque le créancier (destinataire du paiement). La dénomination du client de la banque doit
    être précédée des mots "En faveur de" sur le BVR / BVR+. La dénomination elle-même doit permettre au débiteur et à l'institut
    financier d'identifier sans équivoque le bénéficiaire final.

Numéro de référence:
:   Le numéro de référence est numérique et comporte de 16 à 27 positions. Dans le cas normal, les 27 positions sont utilisées. 20
    de ces positions sont à disposition de l'auteur de la facture (p. ex., pour le numéro de facture, le numéro de client, le
    montant, etc.). Sur un BVRB, les 6 premières positions de ce numéro sont toujours utilisées pour l'identification BVRB. La
    27ème position est occupée par un chiffre-clé.

    Représentation du numéro de référence:

    -   _Ligne de codage_: les positions inutilisées doivent toujours être remplies par des zéros placés à gauche.

    -   _Cadre de référence du document de traitement_: le numéro de référence doit être justifié à droite, en blocs de 5
        positions, plus, si nécessaire, un bloc avec les positions restantes. Les zéros sur la gauche peuvent être supprimés. Le
        cadre de référence est obligatoire.

    -   _Récépissé_: groupage libre (les chiffres peuvent être imprimés en continu), les zéros sur la gauche peuvent être
        supprimés.

Rejet
:   Est désigné par rejet un BVR qui n'a pas pu être traité de façon automatisée par Postfinance.

    Raisons possibles: détérioration, souillure, position incorrecte de la ligne de codage, police incorrecte dans la ligne de
    codage, chiffre-clé faux, structure incorrecte de la ligne de codage, etc.

Structure BVRB
--------------------------

La structure et la position correctes de la ligne de codage et du jeu de caractères OCR-B1 sont indispensables pour assurer un
traitement automatisé des justificatifs.

![](paiements/esr.png)

Figure: bulletin de versement, structure de la ligne de codage avec numéro de référence à 27 positions; légende: P: chiffre-clé

1.  Numéro d'adhérent postal de votre banque (exemple `01-2654-0`)

2.  Votre numéro d'adhérent interne (exemple `999999`)

3.  Code de genre de justificatif, aligner à gauche sur la ligne de codage:

    -   `01`: pour BVR/ BVRB (avec montant)
    -   `04`: pour BVR/ BVRB+ (sans montant)

4.  Montant

    Le montant figurant dans la ligne de codage doit concorder avec ceux des champs de montant. Le montant à virer peut être
    préimprimé sur le bulletin de versement (BVR/BVRB) ou rempli par le payeur (BVR+/BVRB+).

5.  Chiffre-clé

    La présence d'éléments perturbateurs, tels que souillures, empreintes de timbre, caractères imprimés modifiés à la main,
    peuvent entraîner des problèmes de lecture des documents. Des caractères incomplets ou illisibles entraînent un rejet ou des
    erreurs de lecture des documents. Pour éviter ces erreurs, les lignes de codage sont complétées avec des chiffres-clés. La
    méthode utilisée pour le calcul du chiffre-clé est le modulo 10, récursif.

6.  Numéro d'adhérent postal de votre banque (sans trait d'union! Exemple: `010026540`)

7.  Dénomination du client

    Les dénominations du client apposées sur le BVR/BVRB doivent permettre au débiteur et à l'institut financier d'identifier sans
    équivoque le créancier. Les points suivants doivent être respectés: avec inscription au registre du commerce: dénomination
    exacte telle qu'elle figure au registre. Sans inscription au registre du commerce: nom, prénom et siège commercial ou la même
    dénomination que celle du compte bancaire sociétés, associations et fondations: conformément aux statuts ou à l'acte de
    fondation, ainsi que le siège des affaires. Autorités et administrations publiques: dénomination officielle complète et
    domicile. Le nom de la localité du domicile ou du siège des affaires doit être précédé du numéro postal d'acheminement.

    Si le client ne peut pas être identifié de façon explicite, les paiements seront éventuellement refusés.

8.  Dénomination du débiteur

    Le débiteur doit figurer sur le document de traitement et sur le récépissé. Sur le document de traitement, il faut indiquer
    l'adresse postale complète (nom, rue ou case postale, numéro postal d'acheminement et localité). Aucune information
    supplémentaire ne doit être apposée.

Versements
----------------------

### Versement directement au bénéficiaire (BVR & BVR+)

Le versement doit être effectué sur un compte postal. Les bulletins de versement correspondants (format: A4, intégré et neutre)
peuvent être commandés directement auprès de votre conseiller à la clientèle de Postfinance. Vous en recevez 2000 exemplaires
gratuits par an.

On distingue entre BVR / BVR+ et à cases / à cadres.

#### BVR

Les factures BVR sont établies avec un champ de montant rempli. Les champs de montant peuvent dans ce cas être à cases ou à
cadres. Il n'est pas nécessaire que le montant soit placé exactement dans les cases. CLX.ClubMaker imprime automatiquement le
montant correct dans les cases.

![](paiements/esr-mi-509f798bd5.png)

Figure: BVR à cases avec montant préimprimé

![](paiements/esr-mi-d41074c88e.png)

Figure: BVR à cadres avec montant préimprimé

Vous devriez toujours imprimer les bulletins de versement à cadres avec un montant préimprimé. Les BVR à cadres, sans montants
(=BVR+) ou avec un montant de CHF 0.00 (zéro) ne sont pas autorisés!

#### BVR+

Si vous établissez des factures BVR+, le champ du montant est laissé vide. Le destinataire de la facture peut ainsi choisir
combien il veut payer.

![](paiements/esr-oh-e10d7b4bc6.png)

Figure 3: BVR+, aucun montant préimprimé, obligatoirement à cases, le montant manuscrit doit être écrit exactement dans les
cases.

### Versement indirect au bénéficiaire (compte bancaire; BVRB & BVRB +)

Le versement doit être effectué sur un compte bancaire. Là aussi, on distingue entre BVRB / BVRB+ et à cases / à cadres.

#### BVRB

Le champ réservé au montant est rempli lors de l'établissement de factures BVRB. Le montant devrait être écrit exactement dans les cases. Le versement est effectué à la banque en tant que bénéficiaire direct ("Versement pour"), lequel reconnaît à son tour le bénéficiaire indirect à l'aide du numéro d'adhérent interne ("En faveur de"). Aucune information n'est admise.

![](paiements/besr-mit.png)

Figure 1: BVRB à cases avec montant préimprimé

![](paiements/besr-g-02860109c1.png)

Figure 2: BVRB à cadres avec montant préimprimé

<#alert warning />

Les bulletins de versement bancaires avec cadres doivent toujours être imprimés avec un champ de montant rempli! Les BVRB à
cadres, sans montants (BVRB+) ou avec un montant de CHF 0.00 (zéro) ne sont pas autorisés.

<#endalert />

#### BVBR+

Si vous établissez des factures BVRB+, le champ du montant est laissé vide. Le destinataire de la facture peut ainsi choisir
combien il veut payer.

![](paiements/besr-ohne.png)

Figure 3: BVRB+ à cases, sans montant préimprimé

Les BVRB+ à cadres ne sont pas autorisés!
