<aside id="sidebar">

    <?php 
    if(is_active_sidebar('sidebar-post') && (is_home() || is_category || is_tag())){
        dynamic_sidebar('sidebar-post');
    }
    
    else{
        dynamic_sidebar('sidebar-main');
    }
    ?>
    
</aside><!-- end #sidebar -->