## Currencies

Manipulate SAMinfo currency names; currency names are predefined and conform to the ISO 4217 specification. This API allows to:

-   [List currencies](#list)
-   [List currencies with partition](#partitionlist)
-   [Create a new currency](#create)
-   [Update an existing currency](#update)
-   [Delete an existing currency](#delete)

Note that the currency table does not contain any exchange rate information; this is handled through the **Forex** API.

With the [AIT toolchain](https://github.com/ISLEcode/AIT), the specifications can be extracted as such:


``` {.sh}
md-cdata --strip --cdata=fenced --label=list --style=sql \
    https://github.com/PATinfo/sam-mobile/wiki/API-Currency
```

``` {.sql}
SELECT
  NoMonnaie as Id,
  MON_LibelleCourt as Code,
  MON_LibelleLong as Name
FROM gp_:account.monnaie
WHERE 1=1
 [AND MON_LibelleCourt LIKE '%:query%']
ORDER BY :sort_fields
```

<a name="list"></a>
### List currencies

~~~{.rest #list}
GET /saminfo/:account/currency/list
~~~

| Parameter   | Type          | Mandatory | Description |
| :---------- | :-----------: | :-------: | :---------- |
| value_code  | string[50]    | no        | Code to filter list |
| sort_fields | string[255]   | yes       | Comma separated list of (SQL) fields to sort result |


~~~{.sql #list}
SELECT
  NoMonnaie as Id,
  MON_LibelleCourt as Code,
  MON_LibelleLong as Name
FROM gp_:account.monnaie
WHERE 1=1
 [AND MON_LibelleCourt LIKE '%:value_code%']
ORDER BY :sort_fields
~~~

<a name="partitionlist"></a>
### List currencies with partition

~~~{.rest #list-partition}
GET /saminfo/:account/currency/partition-list
~~~

| Parameter   | Type          | Mandatory | Description |
| :---------- | :-----------: | :-------: | :---------- |
| value_code  | string[50]    | no        | Code to filter list |
| sort_fields | string[255]   | yes       | Comma separated list of (SQL) fields to sort result. |
| item_count  | integer       | yes       | Number of items per page in result set (default: 10) |

~~~{.sql #list-partition}
SELECT
  NoMonnaie as Id,
  MON_LibelleCourt as Code,
  MON_LibelleLong as Name,
  ROW_NUMBER() OVER (ORDER BY :sort_fields) as PartitionRowId,
  PartitionNbRows,
  PartitionNbRowsByPage,
  CEILING(NbRows/NbRowsByPage) as PartitionNbPages,
  CEILING(ROW_NUMBER() OVER (ORDER BY :sort_fields)/NbRowsByPage) as PartitionNoPage
FROM (
SELECT
  (SELECT COUNT(*) FROM gp_:account.monnaie WHERE 1=1 [AND MON_LibelleCourt LIKE '%:value_code%']) as NbRows,
  :item_count as NbRowsByPage,
  NoMonnaie,
  MON_LibelleCourt,
  MON_LibelleLong
FROM gp_:account.monnaie
WHERE 1=1
 [AND MON_LibelleCourt LIKE '%:value_code%']) scope
~~~

<a name="create"></a>
### Create a new currency

~~~{.rest #create}
POST /saminfo/:account/currency/create
~~~

| Parameter   | Type          | Mandatory | Description |
| :---------- | :-----------: | :-------: | :---------- |
| new_code    | string[50]     | yes       | Name of the currency (iso4217) |
| new_name    | string[255]    | yes       | Currency's full name (in French -- quid translations) |

~~~{.sql #create}
INSERT INTO gp_:account.monnaie
  (
  MON_LibelleCourt,
  MON_LibelleLong
  )
VALUES
  (
  ':new_code',
  ':new_name'
  )
~~~

<a name="update"></a>
### Update an existing currency

~~~{.rest #update}
PATCH /saminfo/:account/currency/update
~~~

| Parameter   | Type          | Mandatory | Description |
| :---------- | :-----------: | :-------: | :---------- |
| id          | integer       | yes       | Id of table money|
| new_code    | string[50]     | yes       | Name of the currency (iso4217) |
| new_name    | string[255]    | yes       | Currency's full name (in French -- quid translations) |

~~~{.sql #update}
UPDATE gp_:account.monnaie
SET
  MON_LibelleCourt = ':new_code',
  MON_LibelleLong = ':new_name'
WHERE NoMonnaie = :id
~~~

<a name="delete"></a>
### Delete an existing currency

~~~{.rest #delete}
PATCH /saminfo/:account/currency/delete
~~~

| Parameter   | Type          | Mandatory | Description |
| :---------- | :-----------: | :-------: | :---------- |
| id          | integer       | yes       | Id of table money|

~~~{.sql #delete}
DELETE FROM gp_:account.monnaie
WHERE NoMonnaie = :id
~~~
