<template>
    <div id="app">
        <ejs-grid ref='grid' 
        uid="12341234"
        :dataSource='data' height='290px' allowPaging='true' :toolbar='toolbarOptions' 
        :editSettings='editSettings' :actionBegin='actionBegin'
        
        
        :allowResizing="true"
        :allowSorting="true"
        :allowFiltering="true"
        :filterSettings="filterOptions"
        :load="load"
        :allowGrouping="true"
        :groupSettings="groupOptions"

        >
            <e-columns>
                <e-column field='Account' headerText='Account' isPrimaryKey='true' textAlign='right' width=120></e-column>
                <e-column field='Type' headerText='Type' width=150></e-column>
                <e-column field='Apr-2019' headerText='Apr-2019' format='C2'></e-column>
                <e-column field='May-2019' headerText='May-2019' format="C2"></e-column>
            </e-columns>
            <e-aggregates>
             <e-aggregate>
                    <e-columns>
                        <e-column type="Sum" field="Apr-2019" format="c2" :footerTemplate ='footerSum'></e-column>
                    </e-columns>
                </e-aggregate>
          </e-aggregates>
        </ejs-grid>
    </div>
</template>
<script>
import Vue from "vue";
import { GridPlugin, Page, Aggregate, Toolbar, Edit, Sort, Group } from "@syncfusion/ej2-vue-grids";

Vue.use(GridPlugin);
let selectedRecord = {};
var isInitialRender = true;
var isInitialLoad = null;
export default {
  data() {
    return {
      data: [

        {
            "Account": 10248,
            "Type": "Type 1",
            "CustomerName": "Maria ",
            "OrderDate": "1996-07-04T00:00:00.000Z",
            "ShippedDate": "1996-07-16T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Vins et alcools Chevalier",
            "ShipAddress": "59 rue de l'Abbaye",
            "ShipCity": "Reims",
            "ShipRegion": null,
            "ShipCountry": "France",
            "Verified": true
        },
        {
            "OrderID": 10248,
            "CustomerID": "Type 2",
            "CustomerName": "Ana Trujillo",
            "OrderDate": "1996-07-05T00:00:00.000Z",
            "ShippedDate": "1996-07-10T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,            "ShipName": "Toms Spezialitäten",
            "ShipAddress": "Luisenstr. 48",
            "ShipCity": "Münster",
            "ShipRegion": null,
            "ShipCountry": "Germany",
            "Verified": true
        },
        {
            "OrderID": 10248,
            "CustomerID": "HANAR",
            "CustomerName": "Antonio Moreno",
            "OrderDate": "1996-07-08T00:00:00.000Z",
            "ShippedDate": "1996-07-12T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Hanari Carnes",
            "ShipAddress": "Rua do Paço, 67",
            "ShipCity": "Rio de Janeiro",
            "ShipRegion": "RJ",
            "ShipCountry": "Brazil",
            "Verified": true
        },
        {
            "OrderID": 10251,
            "CustomerID": "VICTE",
            "CustomerName": "Thomas Hardy",
            "OrderDate": "1996-07-08T00:00:00.000Z",
            "ShippedDate": "1996-07-15T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Victuailles en stock",
            "ShipAddress": "2, rue du Commerce",
            "ShipCity": "Lyon",
            "ShipRegion": null,
            "ShipCountry": "France"
        },
        {
            "OrderID": 10252,
            "CustomerID": "SUPRD",
            "CustomerName": "Christina Berglund",
            "OrderDate": "1996-07-09T00:00:00.000Z",
            "ShippedDate": "1996-07-11T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Suprêmes délices",
            "ShipAddress": "Boulevard Tirou, 255",
            "ShipCity": "Charleroi",
            "ShipRegion": null,
            "ShipCountry": "Belgium"
        },
        {
            "OrderID": 10253,
            "CustomerID": "HANAR",
            "CustomerName": "Hanna Moos",
            "OrderDate": "1996-07-10T00:00:00.000Z",
            "ShippedDate": "1996-07-16T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Hanari Carnes",
            "ShipAddress": "Rua do Paço, 67",
            "ShipCity": "Rio de Janeiro",
            "ShipRegion": "RJ",
            "ShipCountry": "Brazil",
            "Verified": true
        },
        {
            "OrderID": 10254,
            "CustomerID": "CHOPS",
            "CustomerName": "Frédérique Citeaux",
            "OrderDate": "1996-07-11T00:00:00.000Z",
            "ShippedDate": "1996-07-23T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Chop-suey Chinese",
            "ShipAddress": "Hauptstr. 31",
            "ShipCity": "Bern",
            "ShipRegion": null,
            "ShipCountry": "Switzerland"
        },
        {
            "OrderID": 10255,
            "CustomerID": "RICSU",
            "CustomerName": "Martín Sommer",
            "OrderDate": "1996-07-12T00:00:00.000Z",
            "ShippedDate": "1996-07-15T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Richter Supermarkt",
            "ShipAddress": "Starenweg 5",
            "ShipCity": "Genève",
            "ShipRegion": null,
            "ShipCountry": "Switzerland"
        },
        {
            "OrderID": 10256,
            "CustomerID": "WELLI",
            "CustomerName": "Laurence Lebihan",
            "OrderDate": "1996-07-15T00:00:00.000Z",
            "ShippedDate": "1996-07-17T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Wellington Importadora",
            "ShipAddress": "Rua do Mercado, 12",
            "ShipCity": "Resende",
            "ShipRegion": "SP",
            "ShipCountry": "Brazil"
        },
        {
            "OrderID": 10257,
            "CustomerID": "HILAA",
            "CustomerName": "Elizabeth Lincoln",
            "OrderDate": "1996-07-16T00:00:00.000Z",
            "ShippedDate": "1996-07-22T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "HILARION-Abastos",
            "ShipAddress": "Carrera 22 con Ave. Carlos Soublette #8-35",
            "ShipCity": "San Cristóbal",
            "ShipRegion": "Táchira",
            "ShipCountry": "Venezuela",
            "Verified": true
        },
        {
            "OrderID": 10258,
            "CustomerID": "ERNSH",
            "CustomerName": "Victoria Ashworth",
            "OrderDate": "1996-07-17T00:00:00.000Z",
            "ShippedDate": "1996-07-23T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Ernst Handel",
            "ShipAddress": "Kirchgasse 6",
            "ShipCity": "Graz",
            "ShipRegion": null,
            "ShipCountry": "Austria",
            "Verified": true
        },
        {
            "OrderID": 10259,
            "CustomerID": "CENTC",
            "CustomerName": "Patricio Simpson",
            "OrderDate": "1996-07-18T00:00:00.000Z",
            "ShippedDate": "1996-07-25T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Centro comercial Moctezuma",
            "ShipAddress": "Sierras de Granada 9993",
            "ShipCity": "México D.F.",
            "ShipRegion": null,
            "ShipCountry": "Mexico"
        },
        {
            "OrderID": 10260,
            "CustomerID": "OTTIK",
            "CustomerName": "Francisco Chang",
            "OrderDate": "1996-07-19T00:00:00.000Z",
            "ShippedDate": "1996-07-29T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Ottilies Käseladen",
            "ShipAddress": "Mehrheimerstr. 369",
            "ShipCity": "Köln",
            "ShipRegion": null,
            "ShipCountry": "Germany"
        },
        {
            "OrderID": 10261,
            "CustomerID": "QUEDE",
            "CustomerName": "Yang Wang",
            "OrderDate": "1996-07-19T00:00:00.000Z",
            "ShippedDate": "1996-07-30T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Que Delícia",
            "ShipAddress": "Rua da Panificadora, 12",
            "ShipCity": "Rio de Janeiro",
            "ShipRegion": "RJ",
            "ShipCountry": "Brazil",
            "Verified": true
        },
        {
            "OrderID": 10262,
            "CustomerID": "RATTC",
            "CustomerName": "Pedro Afonso",
            "OrderDate": "1996-07-22T00:00:00.000Z",
            "ShippedDate": "1996-07-25T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Rattlesnake Canyon Grocery",
            "ShipAddress": "2817 Milton Dr.",
            "ShipCity": "Albuquerque",
            "ShipRegion": "NM",
            "ShipCountry": "USA"
        },
        {
            "OrderID": 10263,
            "CustomerID": "ERNSH",
            "CustomerName": "Elizabeth Brown",
            "OrderDate": "1996-07-23T00:00:00.000Z",
            "ShippedDate": "1996-07-31T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Ernst Handel",
            "ShipAddress": "Kirchgasse 6",
            "ShipCity": "Graz",
            "ShipRegion": null,
            "ShipCountry": "Austria",
            "Verified": true
        },
        {
            "OrderID": 10264,
            "CustomerID": "FOLKO",
            "CustomerName": "Sven Ottlieb",
            "OrderDate": "1996-07-24T00:00:00.000Z",
            "ShippedDate": "1996-08-23T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Folk och fä HB",
            "ShipAddress": "Åkergatan 24",
            "ShipCity": "Bräcke",
            "ShipRegion": null,
            "ShipCountry": "Sweden"
        },
        {
            "OrderID": 10265,
            "CustomerID": "BLONP",
            "CustomerName": "Ann Devon",
            "OrderDate": "1996-07-25T00:00:00.000Z",
            "ShippedDate": "1996-08-12T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Blondel père et fils",
            "ShipAddress": "24, place Kléber",
            "ShipCity": "Strasbourg",
            "ShipRegion": null,
            "ShipCountry": "France"
        },
        {
            "OrderID": 10266,
            "CustomerID": "WARTH",
            "CustomerName": "Roland Mendel",
            "OrderDate": "1996-07-26T00:00:00.000Z",
            "ShippedDate": "1996-07-31T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Wartian Herkku",
            "ShipAddress": "Torikatu 38",
            "ShipCity": "Oulu",
            "ShipRegion": null,
            "ShipCountry": "Finland"
        },
        {
            "OrderID": 10267,
            "CustomerID": "FRANK",
            "CustomerName": "Aria Cruz",
            "OrderDate": "1996-07-29T00:00:00.000Z",
            "ShippedDate": "1996-08-06T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Frankenversand",
            "ShipAddress": "Berliner Platz 43",
            "ShipCity": "München",
            "ShipRegion": null,
            "ShipCountry": "Germany",
            "Verified": true
        },
        {
            "OrderID": 10268,
            "CustomerID": "GROSR",
            "CustomerName": "Diego Roel",
            "OrderDate": "1996-07-30T00:00:00.000Z",
            "ShippedDate": "1996-08-02T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "GROSELLA-Restaurante",
            "ShipAddress": "5ª Ave. Los Palos Grandes",
            "ShipCity": "Caracas",
            "ShipRegion": "DF",
            "ShipCountry": "Venezuela"
        },
        {
            "OrderID": 10269,
            "CustomerID": "WHITC",
            "CustomerName": "Martine Rancé",
            "OrderDate": "1996-07-31T00:00:00.000Z",
            "ShippedDate": "1996-08-09T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "White Clover Markets",
            "ShipAddress": "1029 - 12th Ave. S.",
            "ShipCity": "Seattle",
            "ShipRegion": "WA",
            "ShipCountry": "USA"
        },
        {
            "OrderID": 10270,
            "CustomerID": "WARTH",
            "CustomerName": "Maria Larsson",
            "OrderDate": "1996-08-01T00:00:00.000Z",
            "ShippedDate": "1996-08-02T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Wartian Herkku",
            "ShipAddress": "Torikatu 38",
            "ShipCity": "Oulu",
            "ShipRegion": null,
            "ShipCountry": "Finland"
        },
        {
            "OrderID": 10271,
            "CustomerID": "SPLIR",
            "CustomerName": "Peter Franken",
            "OrderDate": "1996-08-01T00:00:00.000Z",
            "ShippedDate": "1996-08-30T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Split Rail Beer & Ale",
            "ShipAddress": "P.O. Box 555",
            "ShipCity": "Lander",
            "ShipRegion": "WY",
            "ShipCountry": "USA",
            "Verified": true
        },
        {
            "OrderID": 10272,
            "CustomerID": "RATTC",
            "CustomerName": "Carine Schmitt",
            "OrderDate": "1996-08-02T00:00:00.000Z",
            "ShippedDate": "1996-08-06T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Rattlesnake Canyon Grocery",
            "ShipAddress": "2817 Milton Dr.",
            "ShipCity": "Albuquerque",
            "ShipRegion": "NM",
            "ShipCountry": "USA"
        },
        {
            "OrderID": 10273,
            "CustomerID": "QUICK",
            "CustomerName": "Paolo Accorti",
            "OrderDate": "1996-08-05T00:00:00.000Z",
            "ShippedDate": "1996-08-12T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "QUICK-Stop",
            "ShipAddress": "Taucherstraße 10",
            "ShipCity": "Cunewalde",
            "ShipRegion": null,
            "ShipCountry": "Germany",
            "Verified": true
        },
        {
            "OrderID": 10274,
            "CustomerID": "VINET",
            "CustomerName": "Lino Rodriguez",
            "OrderDate": "1996-08-06T00:00:00.000Z",
            "ShippedDate": "1996-08-16T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Vins et alcools Chevalier",
            "ShipAddress": "59 rue de l'Abbaye",
            "ShipCity": "Reims",
            "ShipRegion": null,
            "ShipCountry": "France"
        },
        {
            "OrderID": 10275,
            "CustomerID": "MAGAA",
            "CustomerName": "Eduardo Saavedra",
            "OrderDate": "1996-08-07T00:00:00.000Z",
            "ShippedDate": "1996-08-09T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Magazzini Alimentari Riuniti",
            "ShipAddress": "Via Ludovico il Moro 22",
            "ShipCity": "Bergamo",
            "ShipRegion": null,
            "ShipCountry": "Italy"
        },
        {
            "OrderID": 10276,
            "CustomerID": "TORTU",
            "CustomerName": "José Pedro Freyre",
            "OrderDate": "1996-08-08T00:00:00.000Z",
            "ShippedDate": "1996-08-14T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Tortuga Restaurante",
            "ShipAddress": "Avda. Azteca 123",
            "ShipCity": "México D.F.",
            "ShipRegion": null,
            "ShipCountry": "Mexico",
            "Verified": true
        },
        {
            "OrderID": 10277,
            "CustomerID": "MORGK",
            "CustomerName": "André Fonseca",
            "OrderDate": "1996-08-09T00:00:00.000Z",
            "ShippedDate": "1996-08-13T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Morgenstern Gesundkost",
            "ShipAddress": "Heerstr. 22",
            "ShipCity": "Leipzig",
            "ShipRegion": null,
            "ShipCountry": "Germany"
        },
        {
            "OrderID": 10278,
            "CustomerID": "BERGS",
            "CustomerName": "Howard Snyder",
            "OrderDate": "1996-08-12T00:00:00.000Z",
            "ShippedDate": "1996-08-16T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Berglunds snabbköp",
            "ShipAddress": "Berguvsvägen  8",
            "ShipCity": "Luleå",
            "ShipRegion": null,
            "ShipCountry": "Sweden"
        },
        {
            "OrderID": 10279,
            "CustomerID": "LEHMS",
            "CustomerName": "Manuel Pereira",
            "OrderDate": "1996-08-13T00:00:00.000Z",
            "ShippedDate": "1996-08-16T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Lehmanns Marktstand",
            "ShipAddress": "Magazinweg 7",
            "ShipCity": "Frankfurt a.M.",
            "ShipRegion": null,
            "ShipCountry": "Germany",
            "Verified": true
        },
        {
            "OrderID": 10280,
            "CustomerID": "BERGS",
            "CustomerName": "Mario Pontes",
            "OrderDate": "1996-08-14T00:00:00.000Z",
            "ShippedDate": "1996-09-12T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Berglunds snabbköp",
            "ShipAddress": "Berguvsvägen  8",
            "ShipCity": "Luleå",
            "ShipRegion": null,
            "ShipCountry": "Sweden",
            "Verified": true
        },
        {
            "OrderID": 10281,
            "CustomerID": "ROMEY",
            "CustomerName": "Carlos Hernández",
            "OrderDate": "1996-08-14T00:00:00.000Z",
            "ShippedDate": "1996-08-21T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Romero y tomillo",
            "ShipAddress": "Gran Vía, 1",
            "ShipCity": "Madrid",
            "ShipRegion": null,
            "ShipCountry": "Spain",
            "Verified": true
        },
        {
            "OrderID": 10282,
            "CustomerID": "ROMEY",
            "CustomerName": "Yoshi Latimer",
            "OrderDate": "1996-08-15T00:00:00.000Z",
            "ShippedDate": "1996-08-21T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Romero y tomillo",
            "ShipAddress": "Gran Vía, 1",
            "ShipCity": "Madrid",
            "ShipRegion": null,
            "ShipCountry": "Spain",
            "Verified": true
        },
        {
            "OrderID": 10283,
            "CustomerID": "LILAS",
            "CustomerName": "Patricia McKenna",
            "OrderDate": "1996-08-16T00:00:00.000Z",
            "ShippedDate": "1996-08-23T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "LILA-Supermercado",
            "ShipAddress": "Carrera 52 con Ave. Bolívar #65-98 Llano Largo",
            "ShipCity": "Barquisimeto",
            "ShipRegion": "Lara",
            "ShipCountry": "Venezuela",
            "Verified": true
        },
        {
            "OrderID": 10284,
            "CustomerID": "LEHMS",
            "CustomerName": "Helen Bennett",
            "OrderDate": "1996-08-19T00:00:00.000Z",
            "ShippedDate": "1996-08-27T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Lehmanns Marktstand",
            "ShipAddress": "Magazinweg 7",
            "ShipCity": "Frankfurt a.M.",
            "ShipRegion": null,
            "ShipCountry": "Germany",
            "Verified": true
        },
        {
            "OrderID": 10285,
            "CustomerID": "QUICK",
            "CustomerName": "Philip Cramer",
            "OrderDate": "1996-08-20T00:00:00.000Z",
            "ShippedDate": "1996-08-26T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "QUICK-Stop",
            "ShipAddress": "Taucherstraße 10",
            "ShipCity": "Cunewalde",
            "ShipRegion": null,
            "ShipCountry": "Germany"
        },
        {
            "OrderID": 10286,
            "CustomerID": "QUICK",
            "CustomerName": "Daniel Tonini",
            "OrderDate": "1996-08-21T00:00:00.000Z",
            "ShippedDate": "1996-08-30T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "QUICK-Stop",
            "ShipAddress": "Taucherstraße 10",
            "ShipCity": "Cunewalde",
            "ShipRegion": null,
            "ShipCountry": "Germany"
        },
        {
            "OrderID": 10287,
            "CustomerID": "RICAR",
            "CustomerName": "Annette Roulet",
            "OrderDate": "1996-08-22T00:00:00.000Z",
            "ShippedDate": "1996-08-28T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Ricardo Adocicados",
            "ShipAddress": "Av. Copacabana, 267",
            "ShipCity": "Rio de Janeiro",
            "ShipRegion": "RJ",
            "ShipCountry": "Brazil"
        },
        {
            "OrderID": 10288,
            "CustomerID": "REGGC",
            "CustomerName": "Yoshi Tannamuri",
            "OrderDate": "1996-08-23T00:00:00.000Z",
            "ShippedDate": "1996-09-03T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Reggiani Caseifici",
            "ShipAddress": "Strada Provinciale 124",
            "ShipCity": "Reggio Emilia",
            "ShipRegion": null,
            "ShipCountry": "Italy",
            "Verified": true
        },
        {
            "OrderID": 10289,
            "CustomerID": "BSBEV",
            "CustomerName": "John Steel",
            "OrderDate": "1996-08-26T00:00:00.000Z",
            "ShippedDate": "1996-08-28T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "B's Beverages",
            "ShipAddress": "Fauntleroy Circus",
            "ShipCity": "London",
            "ShipRegion": null,
            "ShipCountry": "UK"
        },
        {
            "OrderID": 10290,
            "CustomerID": "COMMI",
            "CustomerName": "Renate Messner",
            "OrderDate": "1996-08-27T00:00:00.000Z",
            "ShippedDate": "1996-09-03T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Comércio Mineiro",
            "ShipAddress": "Av. dos Lusíadas, 23",
            "ShipCity": "Sao Paulo",
            "ShipRegion": "SP",
            "ShipCountry": "Brazil"
        },
        {
            "OrderID": 10291,
            "CustomerID": "QUEDE",
            "CustomerName": "Jaime Yorres",
            "OrderDate": "1996-08-27T00:00:00.000Z",
            "ShippedDate": "1996-09-04T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Que Delícia",
            "ShipAddress": "Rua da Panificadora, 12",
            "ShipCity": "Rio de Janeiro",
            "ShipRegion": "RJ",
            "ShipCountry": "Brazil",
            "Verified": true
        },
        {
            "OrderID": 10292,
            "CustomerID": "TRADH",
            "CustomerName": "Carlos González",
            "OrderDate": "1996-08-28T00:00:00.000Z",
            "ShippedDate": "1996-09-02T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Tradiçao Hipermercados",
            "ShipAddress": "Av. Inês de Castro, 414",
            "ShipCity": "Sao Paulo",
            "ShipRegion": "SP",
            "ShipCountry": "Brazil"
        },
        {
            "OrderID": 10293,
            "CustomerID": "TORTU",
            "CustomerName": "Felipe Izquierdo",
            "OrderDate": "1996-08-29T00:00:00.000Z",
            "ShippedDate": "1996-09-11T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Tortuga Restaurante",
            "ShipAddress": "Avda. Azteca 123",
            "ShipCity": "México D.F.",
            "ShipRegion": null,
            "ShipCountry": "Mexico"
        },
        {
            "OrderID": 10294,
            "CustomerID": "RATTC",
            "CustomerName": "Fran Wilson",
            "OrderDate": "1996-08-30T00:00:00.000Z",
            "ShippedDate": "1996-09-05T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Rattlesnake Canyon Grocery",
            "ShipAddress": "2817 Milton Dr.",
            "ShipCity": "Albuquerque",
            "ShipRegion": "NM",
            "ShipCountry": "USA",
            "Verified": true
        },
        {
            "OrderID": 10295,
            "CustomerID": "VINET",
            "CustomerName": "Giovanni Rovelli",
            "OrderDate": "1996-09-02T00:00:00.000Z",
            "ShippedDate": "1996-09-10T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Vins et alcools Chevalier",
            "ShipAddress": "59 rue de l'Abbaye",
            "ShipCity": "Reims",
            "ShipRegion": null,
            "ShipCountry": "France"
        },
        {
            "OrderID": 10296,
            "CustomerID": "LILAS",
            "CustomerName": "Catherine Dewey",
            "OrderDate": "1996-09-03T00:00:00.000Z",
            "ShippedDate": "1996-09-11T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "LILA-Supermercado",
            "ShipAddress": "Carrera 52 con Ave. Bolívar #65-98 Llano Largo",
            "ShipCity": "Barquisimeto",
            "ShipRegion": "Lara",
            "ShipCountry": "Venezuela",
            "Verified": true
        },
        {
            "OrderID": 10297,
            "CustomerID": "BLONP",
            "CustomerName": "Jean Fresnière",
            "OrderDate": "1996-09-04T00:00:00.000Z",
            "ShippedDate": "1996-09-10T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Blondel père et fils",
            "ShipAddress": "24, place Kléber",
            "ShipCity": "Strasbourg",
            "ShipRegion": null,
            "ShipCountry": "France",
            "Verified": true
        },
        {
            "OrderID": 10298,
            "CustomerID": "HUNGO",
            "CustomerName": "Alexander Feuer",
            "OrderDate": "1996-09-05T00:00:00.000Z",
            "ShippedDate": "1996-09-11T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Hungry Owl All-Night Grocers",
            "ShipAddress": "8 Johnstown Road",
            "ShipCity": "Cork",
            "ShipRegion": "Co. Cork",
            "ShipCountry": "Ireland",
            "Verified": true
        },
        {
            "OrderID": 10299,
            "CustomerID": "RICAR",
            "CustomerName": "Simon Crowther",
            "OrderDate": "1996-09-06T00:00:00.000Z",
            "ShippedDate": "1996-09-13T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Ricardo Adocicados",
            "ShipAddress": "Av. Copacabana, 267",
            "ShipCity": "Rio de Janeiro",
            "ShipRegion": "RJ",
            "ShipCountry": "Brazil"
        },
        {
            "OrderID": 10300,
            "CustomerID": "MAGAA",
            "CustomerName": "Yvonne Moncada",
            "OrderDate": "1996-09-09T00:00:00.000Z",
            "ShippedDate": "1996-09-18T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Magazzini Alimentari Riuniti",
            "ShipAddress": "Via Ludovico il Moro 22",
            "ShipCity": "Bergamo",
            "ShipRegion": null,
            "ShipCountry": "Italy",
            "Verified": true
        },
        {
            "OrderID": 10301,
            "CustomerID": "WANDK",
            "CustomerName": "Rene Phillips",
            "OrderDate": "1996-09-09T00:00:00.000Z",
            "ShippedDate": "1996-09-17T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Die Wandernde Kuh",
            "ShipAddress": "Adenauerallee 900",
            "ShipCity": "Stuttgart",
            "ShipRegion": null,
            "ShipCountry": "Germany"
        },
        {
            "OrderID": 10302,
            "CustomerID": "SUPRD",
            "CustomerName": "Pirkko Koskitalo",
            "OrderDate": "1996-09-10T00:00:00.000Z",
            "ShippedDate": "1996-10-09T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Suprêmes délices",
            "ShipAddress": "Boulevard Tirou, 255",
            "ShipCity": "Charleroi",
            "ShipRegion": null,
            "ShipCountry": "Belgium"
        },
        {
            "OrderID": 10303,
            "CustomerID": "GODOS",
            "CustomerName": "Paula Parente",
            "OrderDate": "1996-09-11T00:00:00.000Z",
            "ShippedDate": "1996-09-18T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Godos Cocina Típica",
            "ShipAddress": "C/ Romero, 33",
            "ShipCity": "Sevilla",
            "ShipRegion": null,
            "ShipCountry": "Spain"
        },
        {
            "OrderID": 10304,
            "CustomerID": "TORTU",
            "CustomerName": "Karl Jablonski",
            "OrderDate": "1996-09-12T00:00:00.000Z",
            "ShippedDate": "1996-09-17T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Tortuga Restaurante",
            "ShipAddress": "Avda. Azteca 123",
            "ShipCity": "México D.F.",
            "ShipRegion": null,
            "ShipCountry": "Mexico",
            "Verified": true
        },
        {
            "OrderID": 10305,
            "CustomerID": "OLDWO",
            "CustomerName": "Matti Karttunen",
            "OrderDate": "1996-09-13T00:00:00.000Z",
            "ShippedDate": "1996-10-09T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Old World Delicatessen",
            "ShipAddress": "2743 Bering St.",
            "ShipCity": "Anchorage",
            "ShipRegion": "AK",
            "ShipCountry": "USA",
            "Verified": true
        },
        {
            "OrderID": 10306,
            "CustomerID": "ROMEY",
            "CustomerName": "Zbyszek Piestrzeniewicz",
            "OrderDate": "1996-09-16T00:00:00.000Z",
            "ShippedDate": "1996-09-23T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Romero y tomillo",
            "ShipAddress": "Gran Vía, 1",
            "ShipCity": "Madrid",
            "ShipRegion": null,
            "ShipCountry": "Spain"
        },
        {
            "OrderID": 10307,
            "CustomerID": "LONEP",
            "CustomerName": "Zbyszek Piestrzeniewicz",
            "OrderDate": "1996-09-17T00:00:00.000Z",
            "ShippedDate": "1996-09-25T00:00:00.000Z",
            
            "Apr-2019": 32.38,
            "May-2019": 32.38,
            "ShipName": "Lonesome Pine Restaurant",
            "ShipAddress": "89 Chiaroscuro Rd.",
            "ShipCity": "Portland",
            "ShipRegion": "OR",
            "ShipCountry": "USA"
        }
      
      ],
      filterOptions: {
        type: "Excel"
      },
      numericParams: { params: { change: this.changeFn } },
      toolbarOptions : ['Delete', 'Update', 'Cancel'],
      editSettings : { allowEditing: true, allowDeleting: true, mode: 'Inline' },
      groupOptions: {
          columns: ['Account', 'Type']
      },
      footerSum: function () {
        return  { template : Vue.component('sumTemplate', {
            template: `<span>Sum: {{data.Sum}}</span>`,
            data () {return { data: {}};}
            })
          }
      },
    };
  },
   methods: {
       btnClick: function(event) {
           
    },
    dataBound: function(args) {
      var grid = this.$refs.grid.ej2Instances;
      
    },
    load: function(args) {
        
    },
      actionBegin: function(args){
          if(args.requestType === 'beginEdit'){
           selectedRecord = {};
           selectedRecord = args.rowData;
        };
      },
    changeFn: function(args){
        selectedRecord['Freight'] = args.value;
        let gridObj = this.$refs.grid.ej2Instances;
        console.log([selectedRecord, gridObj])
        gridObj.aggregateModule.parent.refresh(selectedRecord);
    }
  },
  provide : {
      grid: [Page, Aggregate, Edit, Toolbar, Sort, Group]
  }
}
</script>
<style>
    @import url(https://cdn.syncfusion.com/ej2/material.css);
</style>