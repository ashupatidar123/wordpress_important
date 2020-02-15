functions.php file add top below folder file include
require_once ('myFun/ajaxFunctions.php');

====================ajaxFunctions.php=======================
Below code add in ajaxFunctions.php file

add_action("wp_ajax_custom_ajaxCall","handle_insertForm");
add_action("wp_ajax_nopriv_ajaxCall","handle_insertForm");
function handle_insertForm()
{
    
    if($_POST['param']=='contactForm7')
    {
        $formData 	= $_POST;
        $first_name = $formData['fname'];
        $last_name  = $formData['lname'];
        $email      = $formData['email_ajax'];
        $phone      = $formData['phone_ajax'];
        $comments   = $formData['comments_ajax'];

        $postInsert = array(
            'post_type'=>'my_contact',
            'post_title'=>$comments,
            'post_status' => 'publish',
            'comment_status'=>'closed',
            'ping_status' => 'closed',
            'post_name'=>'contact'
        );
        
        $post_id = wp_insert_post($postInsert);
        if($post_id>0){
            add_post_meta($post_id,'first_name',$first_name);
            add_post_meta($post_id,'last_name',$last_name);
            add_post_meta($post_id,'email',$email);
            add_post_meta($post_id,'phone',$phone);
            add_post_meta($post_id,'comments',$comments);

            echo 1; die();
        }else{
        	echo 0; die();
        }
    }
   
}

==============myCustom.js=================
Below code apply on myCustom.js file

set on header section
<script>var my_url   = '<?=admin_url();?>'</script>
<script>var home_url = '<?=home_url();?>'</script>

==================
function ajaxContact(){
	var adminajax = my_url+'admin-ajax.php';

  var fname = $('input[name="fname"]').val();
  var lname = $('input[name="lname"]').val();
	var email = $('email[name="email_ajax"]').val();
	var phone = $('input[name="phone_ajax"]').val();
	var comments = $('textarea[name="comments_ajax"]').val();

	var formData = $('#contactForm').serialize();
	formData += "&action=custom_ajaxCall&param=contactForm7";
	//alert(adminajax); return false;
	$.ajax({
		type:"POST",
		url:adminajax,
		data:formData,
		//dataType:"json",
		success:function(resp){
			
			if(resp>0){
				alert('Congratulations! Message sent successfully.');
				setTimeout(function() {
			        window.location.reload();
			      },1200); return true;
			}else{
				alert('Opps! Form submission failed.');
				var msg="<strong>Opps!</strong> Form submission failed.";
				$('.errorMsg').html(msg);
				$('.errorMsg').show();
				setTimeout(function() {
				  $('.errorMsg').fadeOut(3000);
				}, 5000);
				return false;
			}
			//console.log(resp);
		}
	});
}


=============Form Section========================
<form method="post" id="contactForm">
  <button type="button" class="btn btn-light btn-radius btn-brd grd1 btn-block" onclick="return ajaxContact();">
  Ajax Submit</button>
</form>  
