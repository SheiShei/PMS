<template>
    <section class="main-main-container" style="background-color: rgb(67, 160, 185);">
        <div class="board-wrapper">

            <!--OPEN GALLERY-->
            <transition name="fade" id="galleryView">    
                <div class="overlay" v-if="openGallery">   
                    <div class="gallery">
                        <div style="padding-top: 30px">
                            <p class="text-white">{{ currentSlide+1 }} of {{ images.length }}</p>
                            <button style="margin-top: 30px" @click="openGallery = !openGallery" class="btn btn-eks btn-danger btn-simple" title="Close image viewer"><span class="fa fa-close"></span></button>
                        </div>
                        <img :src="getCurrentImage.src" :alt="getCurrentImage.name"  :title="getCurrentImage.name" style="margin: 0 auto" height="70%">
                        <div>
                            <button @click="prevSlide" :disabled="currentSlide === 0" class="btn btn-primary btn-simple btn-md"><span class="fa fa-arrow-left"></span> PREV</button>
                            <a class="btn btn-primary btn-simple btn-md" :href="getCurrentImage.src" title="Download" download><span class="fa fa-download"></span></a>
                            <button @click="nextSlide" :disabled="currentSlide === images.length-1" class="btn btn-primary btn-simple btn-md">NEXT <span class="fa fa-arrow-right"></span></button>
                        </div>
                    </div>
                </div>
            </transition>

            <!--ADD TASK-->
            <transition name="fade">            
                <div class="overlay" v-if="openTaskForm">
                    <div class="newTaskForm" style="">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><span class="fa fa-tasks"></span> NEW TASK: </h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a @click="openTaskForm = !openTaskForm" class="btn btn-simple btn-close"><i class="fa fa-close"></i></a> 
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Task Name: </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class=" my-input my-inp-blk" value="">
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Desc: </label>
                            </div>
                            <div class="col-md-9">
                                <textarea class="my-text-area my-inp-blk" name="" id="" rows="4"></textarea>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Attach File/s: </label>
                            </div>
                            <div class="col-md-9">
                                <input type="file" class="my-input my-inp-blk" name="" id="" multiple>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-5">
                                <label for="">Assign To: </label>
                                <select class="my-input my-inp-blk" name="" id="">
                                    <option value="">Unassign</option>
                                    <option value="">RJ</option>
                                    <option value="">Shooky</option>
                                    <option value="">Tata</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Points: </label>
                                <input type="number" class="my-input my-inp-blk" name="" id="" value="0" min="0">
                            </div>
                            <div class="col-md-4">
                                <label for="">Due: </label>
                                <input type="date" class="my-input my-inp-blk" name="" id="">
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <button @click="openTaskForm = !openTaskForm" class="btn btn-danger btn-block">Cancel</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-success btn-block">Add to Board</button>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            <!--VIEW TASK-->
            <transition name="fade">
                <div class="overlay" v-if="openTaskView">
                    <div class="taskView" style="">
                        <div class="row">
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <h4><span class="fa fa-tasks"></span> Make a new banner for the ganito & ganyan ang make it more beautiful</h4>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <h4 class="">
                                    <span class="pull-right"><a @click="openTaskView = !openTaskView" class="btn btn-simple btn-close" title="Close"><i class="fa fa-close"></i></a></span>
                                    <span class="pull-right"><a @click="openTaskView = !openTaskView" class="btn btn-simple btn-close" title="Delete This Task"><i class="fa fa-trash-o"></i></a></span>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6><b>ABOUT</b></h6>
                                <hr />
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><span class="fa fa-user-o text-info"></span> Shooky</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><span class="fa fa-trophy text-warning"></span> 10 pts</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><span class="fa fa-clock-o text-danger"></span> Dec. 12, 2019</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><small>Task from JO no. 237874910</small></p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam labore perspiciatis eveniet in cum nulla exercitationem deserunt saepe, earum vitae, accusantium dolorum atque obcaecati ut nemo? Ab exercitationem dolor consectetur?</p>
                                    </div>
                                </div>
                                <h6><b>ATTACHMENTS</b></h6>
                                <hr />
                                <p><a class="btn-default btn-simple btn-sm" href="/images/sample.docx" download><span class="fa fa-file-o"></span> dsjdisdiasnd.txt</a></p>
                                <p style="cursor: pointer"><a @click="openGallery" class="btn-default btn-simple btn-sm"><span class="fa fa-photo"></span> View attached images</a></p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button @click="openTaskView = !openTaskView" class="btn btn-danger btn-block btn-sm">Cancel</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-success btn-block btn-sm">SAVE CHANGES</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6 class="txt-bold">COMMENTS</h6>
                                        <hr />
                                        <div class="comments">
                                            <div class="comment-box" style="">
                                                <div class="comment-msg">
                                                    <div class="comment-sender">
                                                        <h6 class="txt-bold">
                                                            <span><img src="/images/sample.jpg" class="comment-icon"></span>
                                                            Sam <small>3:18am 12-01-2018</small>
                                                        </h6>
                                                    </div>
                                                    <div class="comment-comment">
                                                        <p>This is my fckn comment</p>
                                                    </div>
                                                </div>
                                                <div class="comment-msg">
                                                    <div class="comment-sender">
                                                        <h6 class="txt-bold">
                                                            <span><img src="/images/sample.jpg" class="comment-icon"></span>
                                                            Sam <small>3:18am 12-01-2018</small>
                                                        </h6>
                                                    </div>
                                                    <div class="comment-comment">
                                                        <p>This is my fckn comment with a file
                                                            with fckn Lorem ipsum dolor sit amet consectetur adipisicing elit. A hic, laboriosam laudantium modi neque eveniet tempore exercitationem ratione assumenda cupiditate voluptatibus odio rem iste qui? Quos dolore dolorum sint deleniti.
                                                        </p>
                                                        <p><a class="btn btn-default btn-simple btn-xs" href="/images/sample.docx" download><span class="fa fa-file-o"></span> withfcknfile.txt</a></p>
                                                    </div>
                                                </div>
                                                <div class="comment-msg">
                                                    <div class="comment-sender">
                                                        <h6 class="txt-bold">
                                                            <span>
                                                                <img src="/images/sample.jpg" class="comment-icon">
                                                            </span>
                                                            Yow <small>3:18am 12-01-2018</small>
                                                        </h6>
                                                    </div>
                                                    <div class="comment-comment">
                                                        <p>This is my fckn comment with an image</p>
                                                        <img src="/images/sample.jpg" style="max-height: 100px; max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="comment-msg">
                                                    <div class="comment-sender">
                                                        <h6 class="txt-bold">
                                                            <span><img src="/images/sample.jpg" class="comment-icon"></span>
                                                            Yow <small>3:18am 12-01-2018</small>
                                                        </h6>
                                                    </div>
                                                    <div class="comment-comment">
                                                        <p>This is my fckn comment with multiple images</p>
                                                        <p style="cursor:pointer"><a class="btn btn-default btn-simple btn-xs"><span class="fa fa-photo"></span> View 2 photos</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group is-empty comment-input-wrap">
                                                <button @click="chooseFile" type="button" class="btn btn-md btn-primary btn-fab btn-fab-mini btn-just-icon btn-simple text-center">
                                                    <i class="fa fa-paperclip"></i>
                                                </button>
                                                <textarea class="form-control" placeholder="Write some nice stuff or go home..." rows="2"></textarea><span class="material-input"></span>
                                                <button  class="btn btn-md btn-primary btn-fab btn-fab-mini btn-just-icon btn-simple text-center"><i class="fa fa-send"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            <div class="board-header">
                <div class="board-name">
                    <h4 class="" style="">Web Boards</h4>
                </div>
                <div class="board-info">
                    <p title="Total Tasks"><span class="fa fa-tasks"></span>&nbsp;12</p>
                </div>
                <div class="board-info">
                    <p title="Members"><span class="fa fa-user-o"></span>&nbsp;7</p>
                </div>
                <div class="board-info">
                    <a class="btn btn-white btn-simple btn-xs"><span class="fa fa-bar-chart"></span> View Stats</a>
                </div>
            </div>
            <button class="btn btn-success btn-sm" @click="addListDiv"> + Add New List</button>
            <button class="btn btn-success btn-sm" @click="openTaskForm = !openTaskForm"> + Add Task</button>
            <button class="btn btn-warning btn-sm" @click="openTaskView = !openTaskView"> View Task</button>
            <button class="btn btn-danger btn-sm" @click="openGallery = !openGallery"> Open Gallery</button>
            
            <div class="board-body">
                <list-card v-for="(listDiv , index) in listDivs" :key="index" :listDiv="listDiv"></list-card>
            </div>
        </div>
    </section>
</template>

<script>
import draggable from 'vuedraggable';
import Card from './kanban/Card.vue';
// import Gallery from './kanban/Gallery.vue'
export default {
    components: {
        draggable,
        listCard: Card
        // gallery: Gallery
    },
    props: ['tasksCompleted', 'tasksNotCompleted'],
        data() {
            return {
                tasksNotCompletedNew: this.tasksNotCompleted,
                tasksCompletedNew: this.tasksCompleted,
                listDivs: [
                    {name: 'tghnkm',about: ''},
                    {name: 'tghnkm',about: ''},
                    {name: 'tghnkm',about: ''},
                ],
                showEditList: false,
                noCard: true,
                openTaskForm: false,
                openTaskView: false,
                openGallery: false,
                currentSlide: 0,
                images: [
                    {
                        name: 'image1',                        
                        src:'/images/sample.jpg'
                    },
                    {
                        name: 'image2',
                        src:'/images/nightsky3.jpg'
                    },
                    {
                        name: 'image3',
                        src:'/images/mfilogo.png'
                    }
                ]
            }
        },
        computed:{
            getCurrentImage(){
                return this.images[this.currentSlide]            
            }
        },
        methods: {
            onAdd(event, status) {
                console.log('add');

                let id = event.item.getAttribute('data-id');
                // axios.patch('/demos/tasks/' + id, {
                //     status: status
                // }).then((response) => {
                //     console.log(response.data);
                // }).catch((error) => {
                //     console.log(error);
                // })
            },
            addListDiv(){
                this.listDivs.push({
                    name: "",
                    about: ""
                });
                this.scrollToEnd()
            },
            revert(){
                this.showEditList = !this.showEditList;
            },
            scrollToEnd(){
                var listdiv = document.querySelector(".list-div")
                // var scrollWidth = tas?kdiv.scrollHeight + 200
                listdiv.scrollLeft = taskdiv.scrollWidth
            },
            update() {
                console.log('update');

                // this.tasksNotCompletedNew.map((task, index) => {
                //     task.order = index + 1;
                // });

                // this.tasksCompletedNew.map((task, index) => {
                //     task.order = index + 1;
                // });

                // let tasks = this.tasksNotCompletedNew.concat(this.tasksCompletedNew);

                // axios.put('/demos/tasks/updateAll', {
                //     tasks: tasks
                // }).then((response) => {
                //     console.log(response.data);
                // }).catch((error) => {
                //     console.log(error);
                // })
            },
            nextSlide(){
                // currentSlide + 1
                console.log('Next')
                let max = this.images.length - 1
                let current = this.currentSlide
                if(current != max) this.currentSlide++
            },
            prevSlide(){
                let min = 0
                let current = this.currentSlide
                if(current >= min) this.currentSlide--
            },
            chooseFile() {
                $("#inputFile3").click();
            },

            onFileChange(file) {
                let files = file.target.files || file.dataTransfer.files;
                let data = new FormData();
                if(files.length > 0) {
                    console.log(files);
                }
            }

        }
}
</script>

<style scoped lang="scss">

    //Gallery style
    .btn-eks{
        position: absolute;
        top: 2px;
        right: 0;
    }
    .gallery{
        width: 100%;
        background-color: rgba(0,0,0,0.6);
        height: 100%;
        margin: 0 auto;
        text-align: center;
        padding: 30px auto;
    }
    //end of Gallery style

    // TASK VIEW
    .taskView{
        background-color: white;
        height: 80%; 
        overflow-y: auto;
        width: 80%;
        padding: 10px 30px; 
        margin: 5% auto; 
        border-radius: 5px;
        input, textarea, select {
            padding: 8px 12px;
            height: auto;
            
        }
        label{
            color: #4d4d4d;
        }
        .formfooter{
            position: absolute;
            bottom: 0;
            left: 0;
        }
    }

    //comment section
    .comment-icon{
        height: 20px; 
        width: 20px; 
        border-radius: 50%;
    }
    .comment-box{
        background-color: #f9f9f9; 
        max-height: 300px; 
        overflow-y: auto; 
        border: 1px solid #e4e3e3;
    }
    .comment-input-wrap{
        display: inline-flex;
        width: 100%;
        vertical-align: middle;
        background-color: white;
        box-sizing: border-box;
        padding: 2px 10px;
        position: relative;
        min-height: 70px;
    }
    .comment-input-wrap > textarea{
        width:80%;
    }
    .comment-input-wrap > button{
        width: 10%;
    }
    .comment-msg{
        padding: 3px 10px;

        h6{
            margin: 3px 0; 
        }
        p{
            margin: 3px 25px;
        }
        .comment-comment > img{
            margin: 3px 25px;
        }
    }
    //end of comment section
    //end of Task View

    //ADD TASK style
    .newTaskForm{
        background-color: white;
        height: auto; 
        width: 500px; 
        padding: 10px 30px; 
        margin: 5% auto; 
        border-radius: 5px;
        input, textarea, select {
            padding: 8px 12px;
            height: auto;
        }
        label{
            color: #4d4d4d;
        }
        .formfooter{
            position: absolute;
            bottom: 0;
            left: 0;
        }
    }
    //end of ADD TASK style
    
    //stay here
    .btn-close{
        padding: 3px 5px;
        font-size: 11px;
        margin: 0;
        border-radius: 2px;
    }
    .btn-close:hover{
        color: rgb(235, 42, 42);
    }
    
</style>



