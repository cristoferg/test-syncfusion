<template>
    <div id="app">
        <ejs-grid ref='journal-grid'
        :dataSource='data' height='290px' allowPaging='true' 
        :allowResizing="true"
        :allowSorting="true"
        :allowFiltering="true"
        :load="load"
        :allowGrouping="true"
        :groupSettings="groupOptions"
        :columns="columns"
        :showColumnMenu='true'

        >
        </ejs-grid>
    </div>
</template>
<script>
import Vue from "vue";
import { GridPlugin, Page, Aggregate, ColumnMenu, Edit, Sort, Group } from "@syncfusion/ej2-vue-grids";

Vue.use(GridPlugin);
export default {
    data() {
        return {
        data: [
            {
                Class: 'Class 1',
                Account: 'Account 1',
                Type: 'Type 1',
                Year: '2020',
                Apr2020: 300,
                May2020: 400
            },
            {
                Class: 'Class 1',
                Account: 'Account 1',
                Type: 'Type 1',
                Year: '2020',
                Jun2020: 300
            },
            {
                Class: 'Class 1',
                Account: 'Account 1',
                Type: 'Type 1',
                Year: '2020',
                Jun2020: 300
            },
            {
                Class: 'Class 1',
                Account: 'Account 1',
                Type: 'Type 1',
                Year: '2020',
                Apr2020: 900,
                May2020: 900
            },
            {
                Class: 'Class 1',
                Account: 'Account 1',
                Type: 'Type 2',
                Year: '2020',
                Apr2020: 700,
                May2020: 700,
                Jun2020: 800
            },
            {
                Class: 'Class 1',
                Account: 'Account 2',
                Type: 'Type 1',
                Year: '2020',
                Apr2020: 800,
                May2020: 800
            },
            {
                Class: 'Class 1',
                Account: 'Account 2',
                Type: 'Type 1',
                Year: '2020',
                Apr2020: 200,
                May2020: 100
            },
            {
                Class: 'Class 2',
                Account: 'Account 1',
                Type: 'Type 2',
                Year: '2020',
                Apr2020: 3000,
                May2020: 4000
            },
            {
                Class: 'Class 2',
                Account: 'Account 1',
                Type: 'Type 2',
                Year: '2020',
                Apr2020: 5,
                May2020: 5
            },
        ],
        columns: [
            {
                field: 'Class',
                headerText: 'Class',
                type: 'text',
                visible: true

            },
            {
                field: 'Account',
                headerText: 'Account',
                type: 'text',
                visible: true

            },
            {
                field: 'Year',
                headerText: 'Year',
                type: 'text',
                visible: true

            },
            {
                field: 'Type',
                headerText: 'Type',
                type: 'text',
                visible: true
            },
            {
                field: 'Apr2020',
                headerText: 'Apr',
                type: 'number',
                format: 'C2',
                visible: true

            },
            {
                field: 'May2020',
                headerText: 'May',
                type: 'number',
                format: 'C2',
                visible: true

            },
            {
                field: 'Jun2020',
                headerText: 'Jun',
                type: 'number',
                format: 'C2',
                visible: true

            },
        ],
        aggregates: [
            {
                field: 'Apr2020',
                type: 'Sum',
                format: 'C2'
            },
            {
                field: 'May2020',
                type: 'Sum',
                format: 'C2'
            }
        ],
        groupOptions: {
            columns: ['Class', 'Type', 'Account', 'Year']
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
       
    },
    provide : {
        grid: [Page, Aggregate, Sort, Group, ColumnMenu]
    }
}
</script>
<style>
    @import url(https://cdn.syncfusion.com/ej2/bootstrap.css);
</style>