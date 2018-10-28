<template>
    
    <section class="main-main-container" style="">
        <ul>
            <draggable v-model="notes">
                <li v-for="note in notes" :key="note.id">
                    <a href="#" :style="'background:'+note.color">
                        <h2 contenteditable="true">{{ note.title }}</h2>
                        <p contenteditable="true">{{ note.body }}</p>
                    </a>
                </li>
            </draggable>
        </ul>
    </section>

</template>

<style scoped>
    *{
        margin:0;
        padding:0;
    }
    /* h2,p{
        font-size:100%;
        font-weight:normal;
    } */
    ul,li{
        list-style:none;
    }
    ul{
        overflow:hidden;
        padding:3em;
    }
    ul li a{
        overflow:auto;    
        text-decoration:none;
        color:#000;
        background:#ffc;
        display:block;
        height:20em;
        width:20em;
        padding:1em;
        -moz-box-shadow:5px 5px 7px rgba(33,33,33,1);
        -webkit-box-shadow: 5px 5px 7px rgba(33,33,33,.7);
        box-shadow: 5px 5px 7px rgba(33,33,33,.7);
        -moz-transition:-moz-transform .15s linear;
        -o-transition:-o-transform .15s linear;
        -webkit-transition:-webkit-transform .15s linear;
    }
    ul li{
        margin:1em;
        float:left;
    }
    ul li h2{
        font-size:140%;
        font-weight:bold;
        padding-bottom:10px;
    }
    ul li p{
        font-family:"Reenie Beanie",arial,sans-serif;
        font-size:180%;
    }
    ul li a{
        /* -webkit-transform: rotate(-6deg);
        -o-transform: rotate(-6deg);
        -moz-transform:rotate(-6deg); */
    }
    /* ul li:nth-child(even) a{
        -o-transform:rotate(4deg);
        -webkit-transform:rotate(4deg);
        -moz-transform:rotate(4deg);
        position:relative;
        top:5px;
        background:#cfc;
    } */
    /* ul li:nth-child(3n) a{
        -o-transform:rotate(-3deg);
        -webkit-transform:rotate(-3deg);
        -moz-transform:rotate(-3deg);
        position:relative;
        top:-5px;
        background:#ccf;
    } */
    /* ul li:nth-child(5n) a{
        -o-transform:rotate(5deg);
        -webkit-transform:rotate(5deg);
        -moz-transform:rotate(5deg);
        position:relative;
        top:-10px;
    } */
    ul li a:hover,ul li a:focus{
        box-shadow:10px 10px 7px rgba(0,0,0,.7);
        -moz-box-shadow:10px 10px 7px rgba(0,0,0,.7);
        -webkit-box-shadow: 10px 10px 7px rgba(0,0,0,.7);
        -webkit-transform: scale(1.25);
        -moz-transform: scale(1.25);
        -o-transform: scale(1.25);
        position:relative;
        z-index:5;
    }
    ol{text-align:center;}
    ol li{display:inline;padding-right:1em;}
    ol li a{color:#fff;}
</style>

<script>
import draggable from 'vuedraggable';
export default {
    components: {
        draggable
    },

    data() {
        return {
            notes: [
                {id: 1, title: 'title 1', body: 'Text Content #1', color: '#ffc'},
                {id: 2, title: 'title 2', body: 'Text Content #2', color: '#cfc;'},
                {id: 3, title: 'title 3', body: 'Text Content #3', color: '#ccf'},
                {id: 4, title: 'title 4', body: 'Text Content #4', color: '#c400ce'},
                {id: 5, title: 'title 5', body: 'Text Content #5', color: '#4bce00'},
                {id: 6, title: 'title 6', body: 'Text Content #6', color: '#ce4100'},
            ]
        }
    }
}
</script>
