<template>
    <div class="errordiv">
        <div class="errorcontent">
        <h1 class="text-center">4 <span class="fa fa-frown-o"></span> 4</h1>
        <h3 class="text-center">Oops! The page you requested cannot be found.</h3>
        </div>
	</div>
</template>

<style scoped lang="scss">
div.errordiv{
    display: flex;
    background-color: #f7f7f7;
    width: 100vw;
    height: 100vh;
    padding: 30px;
    .errorcontent{
        h1{
            font-size: 9.8em;
            color: #43a0b9;
        }
        margin: 20vh auto;
        vertical-align: middle;
        h3{
            margin-top: 5px;
            color: #9c9c9c;
        }
    }
}
</style>


