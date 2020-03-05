==========blog.php===========

<?php 
/*
Template Name:   Blog
Author:      Ashu Patidar
 */
get_header(); ?>
<?php 
if (have_posts()):while (have_posts()):the_post();?>
    <div class="information">
        <div class="container">
            <div class="row">
                <div class="col-md-12"> 
                    <h1>News Blog</h1>
                    <div class="searc-form-container">
                        <?php //get_search_form().'/blog'; ?>
                    </div>
                    <?php
                        
                        $args = array();
                        if(isset($_POST['search']))
                        {
                            unset($_SESSION['blog_search_session']);
                            $args['search_title']   =$_POST['title'];
                            $args['search_content'] =$_POST['content'];  

                            $_SESSION['blog_search_session'] = array('search_title'=>$_POST['title'],'search_content'=>$_POST['content']);
                        }
                        else if(isset($_POST['refresh'])){
                            unset($_SESSION['blog_search_session']);
                        }

                        if(!empty($_SESSION['blog_search_session'])){
                            $args['search_title']   = $_SESSION['blog_search_session']['search_title'];
                            $args['search_content'] = $_SESSION['blog_search_session']['search_content'];

                            $search_title = $_SESSION['blog_search_session']['search_title'];
                            $search_content = $_SESSION['blog_search_session']['search_content'];
                        }

                    ?>
                    <form method="post" action="<?=home_url('/blog');?>" class='search-form'>
                        <div class="row">
                            <div class="form-group col-md-5">
                              <input type="text" class="form-control" placeholder="Enter title" name="title" autocomplete="off" value="<?=!empty($search_title)?$search_title:'';?>">
                            </div>
                            <div class="form-group col-md-5">
                              <input type="text" class="form-control" placeholder="Enter content" name="content" autocomplete="off" value="<?=!empty($search_content)?$search_content:'';?>">
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" name="search" class="btn btn-info search-submit"><i class="fa fa-search"></i></button>
                                <button type="submit" name="refresh" class="btn btn-danger"><i class="fa fa-refresh"></i></button>
                            </div>    
                        </div>    
                    </form>
                   

                    <?php                    
                    
                    $posts_per_page=5;
                    $paged = (get_query_var('paged'))?get_query_var('paged'):1;

                    $args['post_type']      ='blog_list';
                    $args['post_status']    ='publish';
                    $args['posts_per_page'] =$posts_per_page;
                    $args['order']          ='DESC';
                    $args['orderby']        ='ID';
                    
                    
                    //$count_blog = wp_count_posts('blog_list');
                    //$total_blog = $count_blog->publish;

                    
                    add_filter('posts_where', 'cc_search_blog',10,2);
                    $loop = new WP_Query($args);
                    remove_filter( 'posts_where', 'cc_search_blog',10,2);
                   
                    $sn = ($paged==1)?1:$posts_per_page*$paged-($posts_per_page-1);
                    if($loop->have_posts()){
                        while ($loop->have_posts()): $loop->the_post();
                        //$postId = the_ID();
                    ?>
                        <div class="content-manage">        
                            <div class="col-md-4 col-12">                          
                                <a href="<?=home_url();?>/?add-to-cart=<?=$post_id;?>">
                                    <img src="http://localhost/Ashvin/wp/lipo/wp-content/uploads/2020/02/product6.png">
                                </a> 
                            </div>
                            <div class="col-md-8 col-12"> 
                                <div class="inner-div brdrBtm"> 
                                    <div class="col-3">
                                        <h3>Title <?=$sn++;?></h3>  
                                    </div>                         
                                    <div class="col-9">
                                        <p><?=the_title();?></p>
                                    </div>
                                </div>

                                <div class="inner-div"> 
                                    <div class="col-3">
                                        <h3>Description</h3>  
                                    </div>                         
                                    <div class="col-9 maxCont">
                                        <p><?=the_content();?></p>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    <?php 
                    endwhile;
                        if($loop->max_num_pages>1){
                            echo '<div class="content-manage">';
                            echo pagination($paged,$loop->max_num_pages);
                            echo '</div>';
                        }
                    }else{
                        echo '<div class="alert alert-danger text-center"><h3>Record not found...</h3></div>';
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
endwhile;
endif; 
 

get_footer(); ?>






==============functions.php=================
===Session start=====
add_action('init', 'start_session', 1);
function start_session() {
    if(!session_id()) {
        session_start();
    }
}





========custom function=========

// Pagination code
if (!function_exists('pagination'))
{
    function pagination($paged='',$max_page='')
    {
        //$big = 999999999;
        if(!$paged){
            //$paged = get_query_var('paged');
        }
        if(!$max_page){
            //$max_page = $wp_query->max_num_pages;
        }
        
        return paginate_links(array(
            //'base'       => str_replace($big, '%#%', esc_url(get_pagenum_link( $big ))),
            'format'     => '?paged=%#%',
            'current'    => max(1,$paged),
            'total'      => $max_page,
            'mid_size'   => 1,
            'prev_text'  => __('«'),
            'next_text'  => __('»'),
            'type'       => 'list',
        ));
    }
}


//Search code

function cc_search_blog($where, &$wp_query) {
    global $wpdb;

    $post_title   = $wp_query->get('search_title');
    $post_content = $wp_query->get('search_content');

    if(!empty($post_title)){
    	$where .= ' AND '.$wpdb->posts. '.post_title LIKE \'%' .$wpdb->esc_like($post_title).'%\'';
    }
    if(!empty($post_content)){
    	$where .= ' AND '.$wpdb->posts. '.post_content LIKE \'%' .$wpdb->esc_like($post_content ).'%\'';
    }
    return $where;
    //echo $where; die();
}





