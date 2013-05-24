<!DOCTYPE html>
<html>

    <h1>Search In Content</h1>
<?php var_dump(isset($_POST['action']) && $_POST['action'] == 'content'); ?>
<br>


<br>
<table>

	<form method="post" action="iter.php">
		<label for="content_1">File with content</label> <input  type="radio" name="action" id="content_1"
			value="content" <?php echo  isset($_POST['action']) && $_POST['action'] == 'content' ? ' checked="checked"   ' : '' ; ?> > 
			
			<br> 
			
			<label for="file_name_1">File path with given name</label> <input
			type="radio" name="action" id="file_name_1" value="file_name" <?php echo isset($_POST['action']) && $_POST['action'] == 'file_name' ? " checked='checked' " : '' ; ?> > 
			
			<br /> Content: 
			
			<input
			type="text" value="" name="value" value="<?php echo isset($_POST['value']) && $_POST['value'] ? $_POST['value'] : ''; ?>" > <br> <input type="submit">

	</form>
</table>

<?php
if (isset($_POST['action']))
{
    
    $action=  $_POST['action'] ;
    
    if (isset($_POST['value']) && $_POST['value'] != '')
    {
        $search_for = $_POST['value'];

        
        if($action=='content')
        {
            echo  $action , ' ' , $search_for   ;
            $di = new RecursiveDirectoryIterator('.');
            
            foreach (new RecursiveIteratorIterator($di) as $filename => $file)
            {
                
                $content = file_get_contents($filename);
                if (preg_match( '/' . $search_for . '/', $content))
                {
                    echo $filename . " " . ' bytes <br/>';
                }
            }
        }
        else
        {
            $di = new RecursiveDirectoryIterator('.');
            
            foreach (new RecursiveIteratorIterator($di) as $filename => $file)
            {
                if (preg_match( "/" . $search_for . "/" , basename($filename)) )
                {
                    echo $filename . '  <br/>';
                }
            }
        }
    }
}

?>
    
    
    