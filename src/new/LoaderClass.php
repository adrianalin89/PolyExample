<?php include 'Model/Product.php';
      include 'Model/Types/Simple.php';
      include 'Model/Types/Configurable.php';
      include 'Model/Types/Bundle.php';

class LoaderClass
{
    private $data = [];
    private $scripts ='';

    public function __construct($data)
    {
        foreach ($data as $item) {
            if ($item['type'] == Simple::TYPE) {
                $this->data[] = Product::loadObject(new Simple($item));
            }
            if ($item['type'] == Configurable::TYPE) {
                $this->data[] = Product::loadObject(new Configurable($item));
            }
            if ($item['type'] == Bundle::TYPE) {
                $this->data[] = Product::loadObject(new Bundle($item));
            }
        }

        $this->scripts = '<script>const productData = JSON.parse(\''.json_encode($data).'\');</script>';
        $this->scripts .= Simple::loadScript();
        $this->scripts .= Configurable::loadScript();
        $this->scripts .= Bundle::loadScript();
    }

    public function getData()
    {
        return $this->data;
    }

    public function getScripts()
    {
        return $this->scripts;
    }

}