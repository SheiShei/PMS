<template>
    
    <section class="main-main-container" style="">
        <button class="btn btn-success btn-sm" type="button" @click="newNote">+ ADD</button>
        <ul>
            <draggable v-model="notes" :options="options" @change="update" :element="'li'">
                <!-- <transition-group name="slide"> -->
                    <li v-for="(note, index) in notes" :key="index">
                        <a href="" @click.prevent>
                            <i @click="deleteNote(note.id)" class="pull-right">&times;</i>
                            <input @input="editNote(note)" v-model="note.title" type="text" placeholder="Title">
                            <textarea @input="editNote(note)" v-model="note.content" name="" id="" cols="26" rows="10" placeholder="Take a note..."></textarea>
                        </a>
                    </li>
                <!-- </transition-group> -->
            </draggable>
        </ul>
    </section>

</template>

<style scoped>
    /* animation */
    .slide-enter-active, .slide-leave-active {
        transition: transform 1s ease-out, opacity 1s ease-out;
    }

    .slide-enter-active {
        transition-delay: .5s;
    }
    .slide-leave-active {
        transition-delay: .5s;
    }

    .slide-enter, .slide-leave-to {
        transform: scale(0);
        opacity: 0;
    }
    /* end of animation */
    i:hover{
        color: red
    }
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
        overflow:hidden;    
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
    /* ul li h2{
        font-size:140%;
        font-weight:bold;
        padding-bottom:10px;
    } */
    ul li input{
        font-size:140%;
        font-weight:bold;
        padding-bottom:10px;
        background: transparent;
        outline: none;
        border: none;
    }
    /* ul li p{
        font-family:"Reenie Beanie",arial,sans-serif;
        font-size:180%;
    } */
    ul li textarea{
        font-family:"Reenie Beanie",arial,sans-serif;
        font-size:180%;
        background: transparent;
        outline: none;
        border: none;
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
    ul li a:hover{
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
import {mapGetters} from 'vuex';

export default {
    components: {
        draggable
    },

    data() {
        return {
            notes: [],
            options: {
                group: 'notes'
            },
        }
    },

    created() {
        this.getNotes();
    },

    methods: {
        newNote() {
            let noteLength = this.notes.length + 1;
            let newNote = {
                id: '',
                title: '', 
                content: '', 
                order: noteLength
            };
            this.notes.unshift(newNote);

            axios.post('/api/addnote', newNote)
                .then((response) => {
                    // console.log(response);
                    newNote.id = response.data.id;
                    this.update();
                    this.$toaster.success('New note added!');
                })
                .catch((error) => {
                    console.log(error);
                    alert('Something went wrong, try reloading the page');
                })
        },

        update() {
            // console.log(this.notes);
            this.notes.map((note, index) => {
                note.order = index + 1;
            });
            // console.log(this.notes);

            axios.patch('/api/updatenoteorder', {
                notes: this.notes
            })
                .then((response) => {
                    // console.log(response);
                    // this.notes = response.data
                })
                .catch((error) => {
                    console.log(error);
                    alert('Something went wrong, try reloading the page');
                })
        },

        getNotes() {
            axios.post('/api/usernotes')
            .then((response) => {
                // console.log(response);
                this.notes = response.data
            })
            .catch((error) => {
                console.log(error);
                alert('Something went wrong, try reloading the page');
            })
        },

        updateNote(note) {
            // console.log(note)
            axios.patch('/api/updatenote', note)
                .then((response) => {
                    // console.log(response);
                    
                })
                .catch((error) => {
                    console.log(error);
                    alert('Something went wrong, try reloading the page');
                })
        },

        deleteNote(id) {
            // console.log(id);
            axios.delete('/api/deletenote', {data: {id:id}})
                .then((response) => {
                    let index = _.findIndex(this.notes, {id: id});
                    this.notes.splice(index, 1);
                    this.update();
                    this.$toaster.warning('deleted!');
                })
                .catch((error) => {
                    alert('Something went wrong, try reloading the page');
                })
        },

        editNote: _.debounce(function (e) {
            this.updateNote(e);
        }, 700),
    }
}
</script>
