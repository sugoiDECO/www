$(function(){
    $.ajax({
        url : "query.php",
        dataType : "json"
    }).done(function(json) {
        $.each(json.images,function(i,image) {
            var html = '<li><p class="movie"><img src="'+image.imgurl+'" alt=""/></p><p class="icon"><img src="'+image.user.avatar_url+'" alt=""/></p><p class="acount">アカウント : '+image.user.username+'</p><p class="comment">コメント : '+image.message+'<br>#すごい災害訓練</p></li>';
            $("ul#ul_index01").append(html);
        });
        $(".ul_pager").jPages({
            containerID : "ul_index01",
            previous : "←", //前へのボタン
            next : "→", //次へのボタン
            perPage : 9, //1ページに表示する個数
            delay : 20, //要素間の表示速度
            animation: "flipInY" //アニメーションAnimate.cssを参考に
        });
    }).fail(function(data) {
    });
});
