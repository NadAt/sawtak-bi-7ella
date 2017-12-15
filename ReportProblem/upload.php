

    <?php

        // 1: Store directory separator (DIRECTORY_SEPARATOR) to a simple variable.
        $ds= DIRECTORY_SEPARATOR; 
        // 2: Declare a variable for destination folder.
        $storeFolder = 'uploads';
        
        if (!empty($_FILES)) {
            // 3: If file is sent to the page, store the file object to a temporary variable.
            $tempFile = $_FILES['file']['tmp_name'];           
            
            // 4: Create the absolute path of the destination folder.
            $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
            
            // 5: Create the absolute path of the uploaded file destination.
            $targetFile =  $targetPath. $_FILES['file']['name']; 
            
            // 6: Move uploaded file to destination.
            move_uploaded_file($tempFile,$targetFile);    
        }
    ?>
  