<template>
    <section class="main-main-container">
        <div class="title-head">
            <h2><span class="fa fa-book"></span> Workbook<small></small></h2>
        </div>
        <div class="wb-title">
                    <div>
                        <img src="/images/agenda_icon_by_Freepik.png" alt="" height="50px">
                    </div>
                    <div class="details">
                        <h5>Potato Corner Website Mockups</h5>
                        <p>Prepared by: Aya, September 5, 2018</p>
                        <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt dolorum eum quia deleniti tempore facilis sunt assumenda eius incidunt? Tempora, eveniet! Tempora ut fuga in nisi voluptatem expedita nesciunt ipsam?</p> -->
                    </div>
                    
                </div>
        <div class="mybox" style="margin: 20px;">
            <div class="mybox-body white-white-bg">
                <div class="wb-viewPerPost">
                    <div class="wb-imageView">
                        <!-- <p class="text-success"><strong>Item 1</strong></p> -->
                        <img src="/images/nightsky3.jpg" style="max-width: 100%" alt="nightsky3.jpg">
                    </div>
                    <div class="wb-detailsPost">
                        <p>
                            <!-- <strong class="text-success"><small>Item 1.&nbsp;&nbsp;&nbsp;</small></strong> -->
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates ducimus, ea hic natus corporis ullam et repellendus vero. Delectus dolor nesciunt inventore, cum possimus animi enim quos?
                        </p>
                        <!-- <h4><small>Rating:</small> 
                            <span class="fa fa-star text-warning"></span>
                            <span class="fa fa-star text-warning"></span>
                            <span class="fa fa-star text-warning"></span>
                            <span class="fa fa-star-o text-default"></span>
                            <span class="fa fa-star-o text-default"></span>
                        </h4> -->
                        <hr>
                        <p><span class="fa fa-commenting-o"></span> by 
                        <span>
                                <img src="/images/luljetta.png" alt="luljetta.jpg" style="height: 20px; width: 20px;">
                            </span>
                        <i>Luljettas</i>:</p>
                        <p>
                            Mas okay sana kung mas dark yung background? Isn't it? Hmmm..
                        </p>
                    </div>
                </div>
                <div class="wb-viewPerPost">
                    <div class="wb-imageView">
                        <!-- <p class="text-success"><strong>Item 1</strong></p> -->
                        <img src="/images/default.png" style="max-width: 100%" alt="nightsky3.jpg">
                    </div>
                    <div class="wb-detailsPost">
                        <p><strong class="text-success"><small>Item 1.&nbsp;&nbsp;&nbsp;</small></strong>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates ducimus, ea hic natus corporis ullam et repellendus vero. Delectus dolor nesciunt inventore, cum possimus animi enim quos?
                        </p>
                        <!-- <h4><small>Rating:</small> 
                            <span class="fa fa-star text-warning"></span>
                            <span class="fa fa-star text-warning"></span>
                            <span class="fa fa-star text-warning"></span>
                            <span class="fa fa-star text-warning"></span>
                            <span class="fa fa-star-o text-default"></span>
                        </h4> -->
                        <hr>
                        <p><span class="fa fa-commenting-o"></span> by <i>Luljettas</i>:</p>
                        <p>
                            Mas okay sana kung mas dark yung background? Isn't it? Hmmm..
                        </p>
                    </div>
                </div>
            </div>
        </div>
           
    </section>
</template>

<style lang="scss" scoped>
.wb-title{
    padding: 10px 20px;
    display: flex;
    // background-color: #367e8e;
    background-color: #2a889e;
    border-left: 3px dashed #a0c1c5;
    // border-left: 6px solid rgb(0, 162, 255);
    div > img{
        display: inline-block;
        margin-right: 5px;
    }
    div.details{
        display: inline-block;
        margin-left: 5px;
        h5,p{
            margin: 0;
        }
        h5{
            font-weight: bold;
            font-size: 15px;
            text-transform: uppercase;
            color: white;
        }
        p{
            font-size: 12px;
            color: whitesmoke;
        }
    }
}





.wb-viewPerPost{
    display: flex;
    width: 100%;
    position: relative;
    margin-bottom: 10px
}
.wb-imageView{
    display: inline-block;
    width: 50%;
    padding: 15px;
    text-align: center;
    img{
        margin: 0 auto;
        border-radius: 5px;
    }
}
.wb-detailsPost{
    display: inline-block;
    width: 50%;
    padding: 15px;
}
.mybox-v2{
    // border: none;
    .mybox-head{
        border: none;
    }
    .mybox-body{
        padding: 0
    }
}
</style>

