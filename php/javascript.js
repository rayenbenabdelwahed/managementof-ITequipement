function myfunction(){
    if(document.getElementById('distr').options[0].selected==true){
        centre=document.getElementById('centre');
        liste=document.getElementById('centre').options;
       
        var i=1;
        while(i<liste.length){
           
            if ( liste.item(i)!=null){
            liste.item(i).remove();}
            
        }
        fils=document.createElement('option');
        fils.setAttribute("name","garage")
        
        list=document.getElementsByName("garage");
        
        if(list.length<1){
            fils.innerHTML="Garage";
        centre.appendChild(fils);
        }
        fils=document.createElement('option');
        fils.setAttribute("name","siège")
        
        list=document.getElementsByName("siège");
        
        if(list.length<1){
            fils.innerHTML="Siege";
        centre.appendChild(fils);
        }
        fils=document.createElement('option');
        fils.setAttribute("name","enfidha")
      
        list=document.getElementsByName("enfidha");
        
        if(list.length<1){
            fils.innerHTML="Enfidha";
        centre.appendChild(fils);
        }
    }
    else if(document.getElementById('distr').options[1].selected==true){

        centre=document.getElementById('centre');
        liste=document.getElementById('centre').options;
        var i=1;
        while(i<liste.length){
           
            if ( liste.item(i)!=null){
            liste.item(i).remove();}
            
        }
        fils1=document.createElement('option');
        fils1.setAttribute("name","siège")
        
        list=document.getElementsByName("siège");
      
        if(list.length<1){
            fils1.innerHTML="Siege";
        centre.appendChild(fils1);
        }
        fils2=document.createElement('option');
        fils2.setAttribute("name","parc")
        
        list=document.getElementsByName("parc");
        
        if(list.length<1){
            fils2.innerHTML="Parc";
        centre.appendChild(fils2);
        }
        fils3=document.createElement('option');
        fils3.setAttribute("name","commercial")
        
        list=document.getElementsByName("commercial");
       
        if(list.length<1){
            fils3.innerHTML="Commercial";
        centre.appendChild(fils3);
        }
        fils4=document.createElement('option');
        fils4.setAttribute("name","jemmel")
        
        list=document.getElementsByName("jemmel");
       
        if(list.length<1){
            fils4.innerHTML="Jemmel";
        centre.appendChild(fils4);
        }
        fils5=document.createElement('option');
        fils5.setAttribute("name","mokninesiège")
        
        list=document.getElementsByName("mokninesiège");
       
        if(list.length<1){
            fils5.innerHTML="Moknine Siege";
        centre.appendChild(fils5);
        }
        fils6=document.createElement('option');
        fils6.setAttribute("name","moknineparc")
       
        list=document.getElementsByName("moknineparc");
        
        if(list.length<1){
            fils6.innerHTML="Moknine Parc";
        centre.appendChild(fils6);
        }
    } else if(document.getElementById('distr').options[2].selected==true) {
        centre=document.getElementById('centre');
        liste=document.getElementById('centre').options;
        
        var i=1;
        while(i<liste.length){
           
            if ( liste.item(i)!=null){
            liste.item(i).remove();}
            
        }
        
        fils=document.createElement('option');
        fils.setAttribute("name","mahdiacentre")
        
        list=document.getElementsByName("mahdiacentre");
        
        if(list.length<1){
            fils.innerHTML="Centre";
        centre.appendChild(fils);
        }
        fils=document.createElement('option');
        fils.setAttribute("name","ElJemsiège")
        
        list=document.getElementsByName("ElJemsiège");
        
        if(list.length<1){
            fils.innerHTML="ElJem Siege";
        centre.appendChild(fils);
        }
        fils=document.createElement('option');
        fils.setAttribute("name","ElJemparc")
      
        list=document.getElementsByName("ElJemparc");
        
        if(list.length<1){
            fils.innerHTML="ElJem Parc";
            centre.appendChild(fils);
        }
    }
}
function myfunction2(){
    listetype=document.getElementById('artype').options;
    listemarq=document.getElementById('armarq').options;
    listemodel=document.getElementById('armodel').option;

    var l=0;
 
    while(l=0){
        if(listetype=document.getElementById('artype').options[l].selected==true){
            console.log(listamrq.item(l).innerHTML);
        }
        l=l+1;
    }
    // var i;
    // var j;
    // var k;
    // for(i=1;i<liste.length;i++){
    //     list=document.getElementsByName(liste.item(i).innerHTML);
    //     if(list.length>1){
    //        for(j=1;j<list.length;j++){
    //             list.item(j).remove();
    //        }
    //     }
    // }
  
}