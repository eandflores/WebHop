<?php
class UploadsController extends AppController {

public function view() {
  if ($this->request->is('post')) {
  	
            
            if ($this->data['Image']) {
                debug($this->data['Image']);
                $image = $this->data['Image']['image'];
                //allowed image types
                $imageTypes = array("image/gif", "image/jpeg", "image/png");
                //upload folder - make sure to create one in webroot
                $uploadFolder = "img/upload/img_local";
                //full path to upload folder
                $uploadPath = WWW_ROOT . $uploadFolder;


                //check if image type fits one of allowed types
                foreach ($imageTypes as $type) {
                    if ($type == $image['type']) {
                      //check if there wasn't errors uploading file on serwer
                        if ($image['error'] == 0) {
                             //image file name
                            $imageName = $image['name'];
                            //check if file exists in upload folder
                            if (file_exists($uploadPath . '/' . $imageName)) {
                                            //create full filename with timestamp
                                $imageName = date('His') . $imageName;
                            }
                            //create full path with image name
                            $full_image_path = $uploadPath . '/' . $imageName;
                            //upload image to upload folder
                            debug($full_image_path,null,true);
                            if (move_uploaded_file($image['tmp_name'], $full_image_path)) {
                                $this->Session->setFlash('File saved successfully');
                                $this->set('imageName',$imageName);
                            } else {
                                $this->Session->setFlash('There was a problem uploading file. Please try again.');
                            }
                        } else {
                            $this->Session->setFlash('Error uploading file.');
                        }
                        break;
                    } else {
                        $this->Session->setFlash('Unacceptable file type');
                    }
                }
            }
        }
	}
}
?>