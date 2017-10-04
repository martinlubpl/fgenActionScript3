<style>
  #content #testlist { 
      list-style-type:none;
      margin:0;
      padding:0;
   }
   #content #testlist li {
     width:200px;
     font:13px Verdana;
     margin:0;
     margin-left:20px;
     padding-left:20px;
     padding:4px;
     cursor:move;
   }
  div.dropmarker {
      height:6px;
      width:200px;
      background: url(/images/dropmarker.png) left top;
      margin-top:-3px;
      margin-left:-5px;
      z-index:1000;
      overflow: hidden;
   }
</style>
<script type="text/javascript" src="scriptaculous-js-1.6.4/lib/prototype.js"></script>
<script type="text/javascript" src="scriptaculous-js-1.6.4/src/scriptaculous.js"></script>


<ul id="testlist">
  <li id="image_1">Lorem ipsum dolor</li>
  <li id="image_2">sit amet</li>
  <li id="image_3">consectetur adipisicing</li>
  <li id="image_4">elit</li>
  <li id="image_5">sed do eiusmod</li>
  <li id="image_7">ut labore et dolore</li>
  <li id="image_6">tempor incididunt</li>
  <li id="image_8">magna aliqua</li>
</ul>

<script type="text/javascript" language="javascript">
  Sortable.create('testlist',{ghosting:true,constraint:false})
  alert(Sortable.serialize('testlist'));
</script>
