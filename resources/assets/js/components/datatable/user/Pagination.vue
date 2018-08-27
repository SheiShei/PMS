<template>

<div class="row" >
    <span>{{pagination.from}} - {{pagination.to}} of {{pagination.total}}</span>
    <ul class="pagination pagination-sm no-margin" >
        <li @click="$emit('prev')"><a>&#60; Prev</a></li>
        <!-- <li v-else :disabled="true"><a></a>Prev</li> -->
        
        <li @click="$emit('next');"><a>Next &#62;</a></li>
        <!-- <li v-else :disabled="true"><a>Next</a></li> -->
    </ul>
</div>
    
</template>

<script>
    export default {
        props: ['pagination']
    }
</script>

<style lang="scss" scoped>
    li { cursor: pointer; }
</style>