<template>
    <!--VIEW TASK-->
    <transition name="fade">
        <div class="overlay">
            <div class="taskView" style="">
                <div class="row">
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <!-- <h4><span class="fa fa-tasks"></span> Make a new banner for the ganito & ganyan ang make it more beautiful</h4> -->
                        <h4><span class="fa fa-tasks"></span><span title="Click to edit"><input v-model="data.title" style="width: 90%" class="taskInput" type="text"></span></h4>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <h4 class="">
                            <span class="pull-right"><router-link :to="{ name: 'kanboard'}" class="btn btn-simple btn-close" title="Close"><i class="fa fa-close"></i></router-link></span>
                            <span class="pull-right"><a class="btn btn-simple btn-close" title="Delete This Task"><i class="fa fa-trash-o"></i></a></span>
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
                                <p><span class="fa fa-trophy text-warning"></span><span title="Click to edit"> <input v-model="data.points" style="width: 20px;padding: 0;" class="taskInput" type="text"> pts</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><span class="fa fa-clock-o text-danger"></span> Dec. 12, 2019</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><small>Task from JO no. 237874910</small></p>
                                <p title="Click to edit" style="width: 100%">
                                <textarea-autosize
                                    style="padding: 0; width: inherit" 
                                    class="taskInput"
                                    ref="teskDescTextArea"
                                    v-model="data.details"
                                    :min-height="5"
                                    >
                                </textarea-autosize></p>
                            </div>
                        </div>
                        <h6><b>ATTACHMENTS</b></h6>
                        <hr />
                        <!-- <p><a class="btn-default btn-simple btn-sm" href="/images/sample.docx" download><span class="fa fa-file-o"></span> dsjdisdiasnd.txt</a></p>
                        <p style="cursor: pointer"><a @click="openGallery" class="btn-default btn-simple btn-sm"><span class="fa fa-photo"></span> View attached images</a></p> -->
                        <div class="row">
                            <div class="col-md-12">
                                <div id="ataskment-wrapper">
                                    <div class="ataskment">
                                        <div class="media">
                                            <div class="media-left media-top">
                                                <a class="ataskment-thumb" href="" @click.prevent="openGallery = !openGallery" target="_blank" 
                                                style="background-image: url('/storage/messages/94e2a4c0-05b3-11e9-8794-e95d86c7b042.jpg')">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <p><b>80989-9898zcas-89sad-414ae8803.jpg</b></p>
                                                <p><span>Added 4 minutes ago</span> - <a @click.prevent href="">Set<!-- (di ko alam tawag) --></a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ataskment">
                                        <div class="media">
                                            <div class="media-left media-top">
                                                <a class="ataskment-thumb" href="" @click.prevent="openGallery = !openGallery" target="_blank" 
                                                style="background-image: url('/images/nightsky3.jpg')">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <p><b>Midinight Sky (1).jpg</b></p>
                                                <p><span>Added 4 minutes ago</span> - <a @click.prevent href="">Remove</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ataskment">
                                        <div class="media">
                                            <div class="media-left media-top">
                                                <a class="ataskment-thumb" href="/images/sample.pdf" download>
                                                    <span><b>PDF</b></span>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <p><b>Sample.pdf</b></p>
                                                <p><span>Added 20 minutes ago</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p style="cursor: pointer"><a @click.prevent class="btn-default btn-simple btn-sm"><span class="fa fa-plus"></span> Add an Attachment</a></p>
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
</template>

<script>
export default {
    data() {
        return {
            data: {
                title: 'Make a new banner for the ganito & ganyan ang make it more beautiful',
                points: '10',
                details: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam labore perspiciatis eveniet in cum nulla exercitationem deserunt saepe, earum vitae, accusantium dolorum atque obcaecati ut nemo? Ab exercitationem dolor consectetur?'
            }
        }
    },
    methods: {
        chooseFile() {
            $("#inputFile3").click();
        },

        onFileChange(file) {
            let files = file.target.files || file.dataTransfer.files;
            let data = new FormData();
            if(files.length > 0) {
                console.log(files);
            }
        },
    }
}
</script>

