<?php
//includes/classes/Playlist.php

class Playlist {
    private $con;
    private $id;
    private $name;
    private $owner;

    public function __construct($con, $data) {
        //this refers to the instance of this class
        //$data is mysqli query data, an array
        if(!is_array($data)) {
            //data is a string; convert it into an array
            $query = mysqli_query($con, "SELECT * FROM playlists WHERE id='$data'");
            $data = mysqli_fetch_array($query);
        }
        //accessing variables associated with object
        $this->con = $con;
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->owner = $data['owner'];
    }

    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }

    public function getOwner() {
        return $this->owner;
    }

    public function getNumberOfSongs() {
        $query = mysqli_query($this->con, "SELECT songId FROM playlistSongs WHERE playlistId='$this->id'");
        return mysqli_num_rows($query);
    }

    public function getSongIds(){
        $query = mysqli_query($this->con, "SELECT songId FROM playlistSongs WHERE playlistId='$this->id' ORDER BY playlistOrder ASC");
        $array = array(); //initialise a new array
        while($rows = mysqli_fetch_array($query)){
            array_push($array, $rows['songId']);
        }
        return $array;
    }

    public static function getPlaylistsDropdown($con, $username) {
        $dropdown = '<select class="item playlist">
                        <option value="">Add to playlist</option>';
        $query = mysqli_query($con, "SELECT id, name FROM playlists WHERE owner='$username'");
        while($row = mysqli_fetch_array($query)) {
            $id = $row['id'];
            $name = $row['name'];

            $dropdown.= "<option value='$id'>$name</option>";
        }            
        return $dropdown . "</select>";
    }
}

?>