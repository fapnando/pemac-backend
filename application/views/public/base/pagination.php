<?php

    if($this->data->prev != ''){       
        $url = ci_site_url($this->data->itens[($this->data->prev-1)]['slug']);        
        echo ' <a class="left" href="'. $url .'"><div id="prev">';
        echo $this->data->itens[($this->data->prev-1)]['titulo'];
        echo '</div></a>';
    }
    
    if($this->data->next != ''){
        $url = ci_site_url($this->data->itens[($this->data->next-1)]['slug']);
        echo ' <a class="right" href="'. $url .'"><div id="next">';
        echo $this->data->itens[($this->data->next-1)]['titulo'];
        echo '</div></a>';
    }
    
?>