
<div id="center" class="clearfix">
    <ul style="margin: 30px 0 0 50px; float:left;" class="clearfix">
        <li class="pull-left" style="margin-right: 10px; height: 15px"><a href="http://www.facebook.cl/buscahop"><img src="/Hop/img/Facebook-48.png"></a></li>
        <li class="pull-left" style="height: 15px"><a href=""><img src="/Hop/img/Twitter-48.png"></a></li>        
    </ul>
    <div id="search-container" class="clearfix">
      <img src="/Hop/img/mc_hop.png" />
        <form action="/Hop/Users/search" method="post" name="formulario" class="clearfix">
            <input name="nombre" type="text" value=""/>
            <input name="local_id" type="hidden" value=""/>
            <button type='submit'><i class='icon-search'></i></button>  
        </form>   
        <div id="category-container">
            <ul class="clearfix">
                <li>
                    <img src="/Hop/img/Hotel-64.png" />
                    <?php $cadena="Alimentos"; ?>
                </li>
                <li>
                    <img src="/Hop/img/Restaurant-64.png" />
                    <?php $cadena="Accesorios Vehículos"; ?>
                </li>
                <li>
                    <img src="/Hop/img/Bus-Station-64.png" />
                    <?php $cadena="Hogar y Muebles"; ?>
                </li>
                <li>
                    <img src="/Hop/img/Gas-Station-64.png" />
                    <?php $cadena="otras"; ?>
                </li>
                <li>
                    <img src="/Hop/img/Beer-64.png" />
                    <?php $cadena="Licores"; ?>
                </li>
                <li>
                    <img src="/Hop/img/Bank-64.png" />
                    <?php $cadena="Relojes y Joyas"; ?>
                </li>
            </ul>  
        </div>
    </div>
    
    <p>Te brindamos la oportunidad de que encuentres tus productos y des a conocer tu empresa, a través de este amigable buscador.</p>
</div>