<?php

class SiteController extends Controller {

    public $layout = 'column1';

    /*
     * 
     * Uso básico de la cache
     * 
     */
    public function actionIndex() {

        if ($datos = Yii::app()->cache->get('varCache')) 
            $html = "Contenido sacado de APC cach&eacute;: " . $datos;
        else {
            $html = "Hola mundo, son las " . date("H:m:s");
            Yii::app()->cache->set('varCache', $html, 300);
        }
        $this->render("index", array('resultado' => $html));
    }

    
    
    /*
     * 
     * Almacenar un vector en la cache y leerlo
     * 
     */
    public function actionTest1() {

        for($i = 0; $i<10; $i++){
            $key = 'var'.$i;
            Yii::app()->cache->set($key, "contenido: ".$i, 300);
            $vector[] = $key;
        }
        
        $html = Yii::app()->cache->mget($vector);
        
        $this->render("test1", array('resultado' => $html));
    }
    

    
    /*
     * 
     * Almacenar un vector en la cache y leerlo, se restaurar a los 5 segundos
     * 
     */
    public function actionTest2() {
        
        if( Yii::app()->cache->offsetExists('clase') )
            $html = Yii::app()->cache->get('clase');
        else{
            $html = "Son las ".date("H:m:s");
            Yii::app()->cache->set('clase', "Cache: " . $html, 5);
        }

        $this->render("test2", array('resultado' => $html));
    }
    
    
    
    
    /*
     * 
     * Almacenar una instancia en cache 
     * 
     */
    public function actionTest3() {
        
        Yii::import('application.extensions.Miclase.Miclase');
        
        if (Yii::app()->cache->offsetExists('miclase')){
            
            $instancia = Yii::app()->cache->get('miclase');
            $instancia->setHtml("Objeto creado con cache");
        }else {
            
            $instancia = new Miclase;
            $instancia->setHtml();
            
            Yii::app()->cache->set('miclase', $instancia, 300);
        }
        
        $html = $instancia->getHtml();

        $this->render("test2", array('resultado' => $html)); 
    }
    
    
    
    
    /*
     * 
     * 
     * Guarda la salida de un action en la cache
     *      
     * 
     */
    public function actionTest4() {
        if ($datos = Yii::app()->cache->get('salidaHtml4')) 
            echo $datos . "Datos de la cache";
        else {
            echo $salida = $this->render("test4", array('sms'=>'refresca para ver la velocidad ahora.'), true);
            
            Yii::app()->cache->set('salidaHtml4', $salida, 300);
        }
    }
    
    
    
    /*
     * 
     * Función para eliminar todas las variables de la cache
     * Si solo se quiere eliminar una variable, se usa:
     *      Yii::app()->cache->delete('variable_cache');
     * 
     */
    public function actionClean(){
        
        if(!Yii::app()->cache->flush())
            throw new Exception("No se ha podido vaciar la cache.");
        
        $this->redirect("index");
    }
}