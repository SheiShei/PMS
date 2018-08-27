<template>
    <table class="table table-striped">
        <thead>
            <tr>
                <th v-for="column in columns" :key="column.name">
                    {{column.label}}
                </th>
            </tr>
        </thead>
        <slot></slot>
    </table>
</template>

<script>
    export default {
        props: ['columns']
    }
</script>

<style lang="scss" scoped>
    th:last-child{
        text-align: right;
    }
</style>