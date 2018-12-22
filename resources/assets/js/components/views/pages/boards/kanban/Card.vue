<template>
    <div class="list-div">
        <div class="list-head">
            <div class="list-title" title="Tasks List">
                <b>Tasks List</b>
            </div>
            <div class="editListBtn pull-right">
                <small>21213 pts</small>
                <button class="" @click="revert"><span class="fa fa-edit"></span></button>
                <button class=""><span class="fa fa-trash-o"></span></button>
            </div>
        </div>
        <div class="list-edit" v-if="showEditList">
            <div class="list-edit-input">
                <input type="text" class="btn-block" value="Task #1">
            </div>
            <div class="list-edit-save">
                <button class="btn-save">SAVE</button>
                <button class="btn-close btn btn-simple btn-default btn-xs" @click="revert" title="Cancel"><span class="fa fa-times"></span></button>
            </div>
        </div>
        <div class="list-body">
            <draggable :move="checkMove" :options="{animation:200, group:'status'}" :element="'div'" @add="onAdd($event, false)">
                <div class="" v-if="noCard" style="background-color: transparent; height: 5px"></div>
                <div class="t-card" @mouseout="openTaskOpt=false" @drag="checkMove">
                    <div class="t-card-wrap" @mouseover="openTaskOpt=!openTaskOpt">
                        <div class="if-fr-jo">
                            <span class="text-success">Task #1</span> MFI Revisionsjkddfsdfd
                        </div>
                        <div class="t-name">
                            <b>Encode the directors data dat data dtatd atd a</b>
                        </div>
                    </div>
                    <transition name="fade">
                        <div class="t-options" v-show="openTaskOpt" style="" @mouseover="openTaskOpt = true" @mouseout="openTaskOpt = false">
                            <div class="t-points">
                                <p>0 pts</p>
                            </div>
                            <div class="t-btns pull-right">
                                <button class="mysm-btn"><span class="fa fa-eye"></span></button>
                                <button class="mysm-btn"><span class="fa fa-edit"></span></button>
                                <button class="mysm-btn"><span class="fa fa-trash-o"></span></button>
                            </div>
                        </div>
                    </transition>
                </div>
                <div class="t-card" @mouseout="openTaskOpt=false">
                    <div class="t-card-wrap" @mouseover="openTaskOpt=!openTaskOpt">
                        <div class="if-fr-jo">
                            <span class="text-success">Task #1</span> MFI Revisionsjkddfsdfd
                        </div>
                        <div class="t-name">
                            <b>Encode the directors data dat data dtatd atd a</b>
                        </div>
                        <div class="t-desc">
                            <img src="/images/nightsky3.jpg" width="100%" alt="">
                        </div>
                    </div>
                    <transition name="fade">
                        <div class="t-options" v-show="openTaskOpt" style="" @mouseover="openTaskOpt = true" @mouseout="openTaskOpt = false">
                            <div class="t-points">
                                <p>10 pts</p>
                            </div>
                            <div class="t-btns pull-right">
                                <button class="mysm-btn"><span class="fa fa-eye"></span></button>
                                <button class="mysm-btn"><span class="fa fa-edit"></span></button>
                                <button class="mysm-btn"><span class="fa fa-trash-o"></span></button>
                            </div>
                        </div>
                    </transition>
                </div>
            </draggable>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable';
export default {
    components: {
        draggable,
    },
    props: ['listDivs'],
    data() {
        return {
            showEditList: false,
            noCard: true,
            openTaskForm: false,
            openTaskOpt: false,
            openTaskView: false,
        }
    },
    mounted() {
        let taskdiv = document.querySelector("#testTaskDiv");
        taskdiv.scrollLeft = taskdiv.scrollWidth;
    },
    methods: {
            delListDiv(index){
                console.log('deleted!');
                this.listDivs.splice(index,1);
            },
            revert(){
                this.showEditList = !this.showEditList;
            },

            checkMove(event) {
                // console.log(event);
                var elmnt = document.querySelector('#testTaskDiv');
                let pos = event.pageX - $('#testTaskDiv').offset().left
                // console.log(`mouse position: ${pos}`);
                if(pos>1000) {
                    elmnt.scrollBy(10, 0);
                }
                if(pos<200) {
                    elmnt.scrollBy(-10, 0);
                }
            }
        }
}
</script>

<style lang="scss" scoped>

    //individual card styles
    .t-card-wrap{
        width: 100%;
        height:auto;
        display: block;
        padding: 9px 12px;
        white-space: normal;

        .if-fr-jo{
            padding-top:1px;
            padding-bottom: 1px;
            line-height: normal;
            font-size: 9px;
            color: #bbbbbb;
        }
        .t-name{
            padding-top:1px;
            padding-bottom: 3px;
            font-size: 13px;
            line-height: normal;
            color: #2b2b2b;
            cursor: move;
            img{
                margin-top: 6px;
            }
        }
        .t-desc{
            padding-top:5px;
            padding-bottom: 10px;
            padding-left: 6px;
            padding-right: 6px;
            line-height: normal;
            font-size: 12px;
            color: rgb(127,127,127);
        }
    }

    .mysm-btn{
        background: transparent;
        color: rgb(105, 105, 105);
        padding: 5px 9px;
        border: none;
        box-shadow: none;
        margin: 0;
        border-radius: 50%;
    }

    .mysm-btn:hover{
        background-color: rgb(199, 199, 199);
        color: rgb(92, 92, 92);
        transition: 0.5s;
    }

    .t-card{
        display:block;
        margin-bottom: 6px;
        background-color: #fff;
        border: 1px solid #d6d5d5;
    }

    .t-options{
        width: 100%;
        height:auto;
        padding: 0;
        padding: 5px 12px;
        white-space: normal; 
        position: relative;

        .t-points{
            display: inline-flex;
            width: 50%;
        }

        .t-btns{
            display: inline-block;
            // float: right;
            text-align: right;
        }
    }
    //end of individual card

    .list-edit{
        padding: 5px 8px;
        background-color: whitesmoke;
        display: flex;

        .list-edit-input{
            display: inline-block;
            width: 70%;
            margin-right: 5px;
            input{
                border: 1px solid rgb(158, 158, 158);
                padding: 2px 3px;
                border-radius: 2px;
                border: 1px solid #4CAF50;
                font-size: 12px;
            }
        }

        .list-edit-save{
            display: inline-block;
            width: 20%;
            button.btn-save{
                width: 100%;
                box-shadow: none;
                border: none;
                border-radius: 2px;
                background-color: #4caf50;
                color: white;
                padding: 3px 5px;
                font-size: 11px;
            }
            button.btn-save:focus{
                background-color: #3e9140;
            }
            button.btn-close{
                padding: 3px 5px;
                font-size: 11px;
                margin: 0;
                border-radius: 2px;
            }
            button.btn-close:hover{
                color: rgb(235, 42, 42);
            }
        }

    }

    .list-head{
        background-color: #dcdcdc;
        position: relative;
    }

    .list-title{
        display:inline-block;
        padding: 5px 8px;
        color: rgb(38,38,38);
        width: 50%;
        font-size: 13px;
        font-style: bold;
        overflow-x: hidden;
    }

    .editListBtn{
        display:inline-block ;
        width: 50%;
        text-align: right;
        button{
            background: transparent;
            color: rgb(105, 105, 105);
            padding: 5px 9px;
            border: none;
            box-shadow: none;
            margin: 0;
            border-radius: 50%;
        }
        button:hover{
            background-color: rgb(199, 199, 199);
            color: rgb(92, 92, 92);
            transition: 0.5s;
        }
    }

    .list-body{
        background-color: rgb(234,234,234);
        max-height: 63vh; 
        overflow-y: auto !important;
        padding: 10px;
    }

    .list-footer{
        background-color: rgb(234,234,234);
    }

    .list-div{
        height: auto;
        width: 300px;
        overflow-y:visible;
        background-color:beige;
        padding: 0;
        margin-top: 10px;
        display: inline-block;
        margin-right: 10px;
        vertical-align:text-top;
    }
    
</style>
