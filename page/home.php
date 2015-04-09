<?php
$messages = $mess->getAllMessage();

foreach($messages as $key => $message) {

    echo '<div class="return">'.htmlspecialchars($message['name'])." : ".htmlspecialchars($message['message'])."</div>";

}


?>