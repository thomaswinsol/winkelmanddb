<?php
/*
 * Deze class zorgt ervoor dat we ons mandje kunnen opvullen,
 * indien een element reeds bestaat in de mand, dan vermeerderen we het aantal
 *
 * @property array $mand
 *
 * @method toevoegenAanMand
 * @method verwijderenUitMand
 * @method mandWeergeven
 *
 */

/**
 * @author xavierdekeyster
 */
class Winkelmand {

    private $_db;

    public function __Construct()
    {
        $this->_db = new Connection;
        $this->_db = $this->_db->connect();

    }

    /**
     * Vult het mandje op
     * @param array $items
     * @return void
     *
     */
    public function toevoegenAanMand($userID, $items) {
        $st = $this->_db->prepare('select * from winkelmanden where ID = :userID and ProductID= :productID');
        $st->execute(array('userID'=>$userID, 'productID'=> $items['ID']));
        if ($st->rowCount() == 1) {
                 $this->update($userID, $items);
        }
        else {
                $this->insert($userID, $items);
        }
    }


    public function update($userID, $items)  {

    }

    public function insert($userID, $items)  {
       
         $st = $this->_db->prepare('insert into winkelmanden (ID , ProductID , Aantal) values( :id, :productid , :aantal  )');
         $st->execute(array(':id'=>$userID, ':productid'=> $items['ID'], ':aantal'=> $items['Aantal']));   
    }
    /**
     * verwijdert een element of vermindert het aantal
     * @param array $items
     * @return void
     */
    public function verwijderenUitMand($itemId) {
        foreach ($this->mand as $key => $value) {
            if ($this->mand[$key]['id'] == $itemId) {
                $this->mand[$key]['aantal'] -= 1;
			if ($this->mand[$key]['aantal'] < 0) {
				$this->mand[$key]['aantal']=0;
			}
                return;
            }
        }
    }

    /**
     * Mandje weergeven als object
     * @return array $this->mand
     */
    public function mandWeergeven($userid) {
        $st = $this->_db->prepare('select * from winkelmanden a , producten b where a.ProductID=b.ID and a.ID = :userid');
        $st->execute(array('userid'=>$userid));
        $result = $st->fetch(PDO::FETCH_ASSOC);
        echo "<pre>";
        print_r($result);
        die("ok");
        return $result;
    }

    /**
     * mand leegmaken
     */
    public function mandLeegmaken($userid) {
	$st = $this->_db->prepare('delete * from winkelmanden where ID = :userID');
        $st->execute(array('userID'=>$userid));
    }

}

?>
