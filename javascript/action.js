  var trigger = document.getElementById("Hum-menu");
  var span1 = document.getElementById("span1");
  var span2 = document.getElementById("span2");
  var span3 = document.getElementById("span3");
  let position = 0;


  /*メニューがScrollした場合に下に下がった場合は色を変更し上に戻った場合は色を戻す*/
  window.addEventListener("scroll", function(){
    if( position < this.document.documentElement.scrollTop ){
      span1.style.backgroundColor ="black";
      span2.style.backgroundColor ="black";
      span3.style.backgroundColor ="black";
    }else{
      span1.style.backgroundColor ="";
      span2.style.backgroundColor ="";
      span3.style.backgroundColor ="";
    }
  });
  /*メニュー制御ここまで*/

  /*ハンバーガーメニューがクリックされた場合の挙動*/
    if(trigger){
        trigger.addEventListener("click",function(){
            var targetspan1 = document.getElementById("span1");
            var targetspan2 = document.getElementById("span2");
            var targetspan3 = document.getElementById("span3");
            var nav = document.getElementById("nav");
            targetspan1.classList.toggle("active");
            targetspan2.classList.toggle("active");
            targetspan3.classList.toggle("active");
            nav.classList.toggle("active");
        },false);
    }
    /*ハンバーガー制御ここまで */
