

    function getting(){
        $.ajax({
            method:"GET",
            url:"chatget.php"
        }).done(function(msg){
           let obj = JSON.parse(msg); //transforme le tableau json en objet.
         //  console.log(obj);
         let txt = "";

         let tab ={
             "tongue":"img/tongue.gif",
             "sunglass":"img/sunglass.gif",
             "ninja":"img/ninja.gif",
             "siffle":"img/siffle.gif",
             "pleure":"img/pleure.gif",
             "diable":"img/diable.gif",
             "angry":"img/angry.gif",
             "smile":"img/smile.gif",
             "sad":"img/sad.gif",
             "loveit":"img/loveit.gif"



            
            };
        
              
         // parcours tag.
       
         
          $.each(obj[0],function(index,obj){
            //  console.log(obj.pseudo);
              //alert(p);
             // txt += "<p>"+obj.pseudo+": "+obj.commentaire+" "+"<img src='"+tab.ange+"'></p>";
             txt += "<p>"+obj.pseudo+": "+obj.commentaire+"</p>";
            // txt = txt.replace(":loveit","hju"); 
            // codeurjava.com/2016/01/parcourir-un-tableau-avec-jquery-each.html
             jQuery.each(tab,function(i,v){
                console.log(i+" "+v); 
                txt = txt.replace(":"+i,"<img src='"+v+"' alt='"+i+"'>"); 
              
             // txt += "index:"+i+" value:"+v+"<br/>";
                //exemple :  :ange sera remplace par l'image : <img src='img/ange.png'>
            })
            // txt = txt.replace(":ange","<img src='"+tab.ange+"'>");
         

              
             
              
          });
          $("#chat").html(txt);
      
        }).fail(function(error){
            console.log(error);
        });
    }


function posting()
   {
    let pseudo_valeur = $("#pseudo").val();
    let commentaire_valeur =$("#commentaire").val();

    
    
   // insertion dans la bdd
    $.ajax({
     method:"POST",
     url:"chatpost.php",
     data:{pseudonyme:pseudo_valeur,comment:commentaire_valeur}
 }).done(function(msg){
     $("#alert").innerHTML = "message posté";
 }).fail(function(error){
     console.log(error);
 });
//recup les commentaires de la bdd 
     getting();
     $("#commentaire").val('');
    }
     
    $(document).ready(function(){
        getting();

        $(".smileys").click(function(){
            $(this).attr("class","smileys clicked"); 
            $("#commentaire").val($("#commentaire").val()+$(this).attr("id"));
            //ajouter un smiley au commentaire quand je clique sur un smiley
            console.log($(this).attr("id"));
        });
    

         $("form").submit(function(evt){
             evt.preventDefault();

            posting();
            
         })

        
      
          
    

        
  
      
});