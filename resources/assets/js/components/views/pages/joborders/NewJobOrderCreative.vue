<template>
    <section class="main-main-container" style="">
        <div class="title-head">
            <h2><span class="fa fa-file-o"></span> Job Order Form - Creatives <small>Panel</small></h2>
        </div>
        <div class="first-column col-md-1">
        </div>
        <div class="col-md-10">
            <div class="joform">
                <div class="jo-head">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="noprint"><span class="fa fa-file-photo-o"></span> Job Order Form <small>(Creatives)</small>
                            &nbsp;&nbsp;&nbsp;
                                <span class="pull-right">
                                    <small>
                                        <select name="" id="" class="my-input">
                                            <option value="">Active</option>
                                            <option value="">Completed</option>
                                            <option value="">Blocked</option>
                                        </select>
                                    </small>
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="jo-body">
                    <form action="">
                        <div class="row form-row">
                            <div class="col-md-3 form-group">
                                <label for="brand">Brand:</label>
                                <div class="btn-group bootstrap-select">
                                    <select class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                        <option class="" value="">Furnitalia</option>
                                        <option value="">Fil-Global</option>
                                        <option value="">Allele</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="brand">Client:</label>
                                <div class="btn-group bootstrap-select">
                                    <select class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                        <option value="">Aya</option>
                                        <option value="">Marley</option>
                                        <option value="">Kwini</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">ACMA / Brand Owner:</label>
                                <div class="btn-group bootstrap-select">
                                    <select multiple class="selectpicker" data-style="btn btn-sm btn-info btn-simple" type="text">
                                        <option value="">Aya</option>
                                        <option value="">Marley</option>
                                        <option value="">Kwini</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="" class="align-right">JO No.</label>
                                <img class="pull-right" style="height: 70px" src="/images/above-art1.jpg" alt="">
                            </div>
                        </div>
                        <hr />
                        <div class="row form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""><span class="fa fa-calendar-o text-success"></span> Date In
                                        <small><i> (dd-mm-yyyy)</i></small></label>
                                    <input class="form-control" type="date" />
                                </div>
                                <div class="form-group">
                                    <label for=""><span class="fa fa-calendar-o text-danger"></span> Date Due
                                        <small><i> (dd-mm-yyyy)</i></small></label>
                                    <input class="form-control" type="date" />
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="rqst_type">Usage / Media:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                IG Post
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                FB Post
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                IG/Messenger Stories
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                Cover Photo
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                Branding (New Brand)
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                Trademark Form
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                Others
                                            </label>
                                        </div>
                                        <textarea name="" id="" rows="2" class="my-text-area btn-block" placeholder="Clearly specify here"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="rqst_type">Ad Type: &nbsp; &nbsp; &nbsp;</label> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                Carousel
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                Canva
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                Gallery
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                Album Type
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                Others
                                            </label>
                                        </div>
                                    </div>
                                </div>     
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="rqst_type">File Type: &nbsp;&nbsp;&nbsp;</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                PDF File
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                JPG File
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                GIF File
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                PNG File (Transparent)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                MP4 File / Video
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                                Boosted
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="">Copy on Artwork:</label>
                                <textarea class="my-text-area btn-block" rows="3" placeholder="Write here. Indicate if any..."></textarea>
                            </div>
                        </div>
                        <hr />
                        <div class="jo-body" style="background-color: whitesmoke">
                            <div class="row pb-10">
                                <div class="col-md-12">
                                    <h5>Add Task 
                                    <span>
                                        <button type="button" @click="addNewTask" class="btn btn-success btn-fab btn-fab-mini"
                                            rel="tooltip" data-original-title="Click to add new task form" data-placement="right">
                                        +
                                        </button>
                                    </span>
                                    </h5>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-10">
                                    <div class="row" id="addtaskdiv">
                                        <div class="col-md-12">
                                            <div class="card taskcard" v-for="(task, index) in tasks" :key="task.id">
                                                <span class="pull-right" @click="deleteTaskForm(index)" style="cursor:pointer"><i class="fa fa-times"></i></span>
                                                <h5 class="text-gray"><span class="fa fa-tasks"></span> Task #{{index+1}}</h5>
                                                <div class="form-row">
                                                    <div class="col-md-7">
                                                        <label for="">Decription </label>
                                                        <textarea type="text" v-model="task.name" class="btn-block" placeholder="" ></textarea>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for=""><span class="fa fa-user-o"></span> Assign to </label>
                                                        <select class="btn-block" name="" id="">
                                                            <option value="">Shooky</option>
                                                            <option value="">Chimmy</option>
                                                            <option value="">RJ</option>
                                                        </select>
                                                        <label for="" style="margin-top: 8px"><span class="fa fa-file-o"></span> Attach File</label>
                                                        <input class="btn-block" type="file" name="" id="" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-3">
                                <label for="rqst_type">Status:</label> 
                                <div class="checkbox mr-10">
                                    <label>
                                    <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                        No Revisions
                                    </label>
                                </div>
                                <div class="checkbox mr-10">
                                    <label>
                                    <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                        Copy Approved for Post
                                    </label>
                                </div>
                                <div class="checkbox mr-10">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                        ACMA/BO Approved for Posting
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="rqst_type">Revisions:</label>
                                <textarea class="my-text-area btn-block" name="" id="" rows="3" placeholder="Fill up this field if there's a revision"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="">Final Sign Off:</label>
                                <div class="checkbox mr-10">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes"><span class="check"></span>
                                        Checking this field means you are confirming the final sign off. (?)
                                    </label>
                                </div>
                                <p class="note">Enter email and password for verification.</p>
                                <input type="email" class="form-control" placeholder="email" name="" id="">
                                <input type="password" class="form-control" placeholder="password" name="" id="">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-md btn-block" type="submit">
                                    DONE!
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1">
        </div>
    </section>
</template>


<script>
export default {
    data(){
        return{
            tasks: [{
                name: '',
                about: ''
            }]
        }
    },
    methods: {
        addNewTask(){
            this.tasks.push({
                name: '',
                about: ''
            })
            this.scrollToEnd()
        },
        deleteTaskForm(index){
            this.tasks.splice(index,1)
        },
        scrollToEnd(){
            var taskdiv = document.querySelector("#addtaskdiv")
            // var scrollHeight = taskdiv.scrollHeight + 200
            taskdiv.scrollTop = taskdiv.scrollHeight

        }
    },
    // mounted(){
    //     this.scrollToEnd();
    // },
    updated(){
        // scrollToEnd()
    }
}
</script>
<style scoped lang="scss">

    @media print{
        .nav-side-menu, noprint{
            display: none;
        }
    }
    table{
        border: 1px solid gray !important;
    }
    label{
        color: #868686 !important;
        font-weight: 700 !important;
        font-size: 0.9em !important;
    }

    .btn-group, .btn-group-vertical {
        position: relative;
        margin: 2px 1px;
    }

    label > small{
        font-weight: normal;
    }
    .jo-barcode{
        margin-top: 10px;
        margin-right: 10px;
        width: 100px;
        height: 100px;
        border: 1px solid gray;
    }
    .btn-group bootstrap-select{
        margin-top: 0px !important;
        margin-bottom: 7px !important;
    }
    div.checkbox > label{
        font-weight: normal !important;
    }
</style>

