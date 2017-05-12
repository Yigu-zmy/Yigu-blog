<div class="container" style="margin-top: 20px">
    <div class="row " >
        <div class="col-md-3 column" >
            <h4 style="text-align: center;background-color: #F0FFF0; height: 30px;padding-top: 7px; border-radius: 10px">热门文章</h4>
            @include('home.hotarticles')
        </div>
        <div class="col-md-6 column" >
            <h4 style="text-align: center;background-color: #F0FFF0; height: 30px;padding-top: 7px; border-radius: 10px">最新文章</h4>
            @include('home.newestarticles')
        </div>
        <div class="col-md-3 column" >
            <h4 style="text-align: center;background-color: #F0FFF0; height: 30px;padding-top: 7px; border-radius: 10px">热门作者</h4>
            @include('home.hotauther')
        </div>
    </div>
</div>
