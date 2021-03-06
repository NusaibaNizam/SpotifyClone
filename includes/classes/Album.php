<?php
	/**
	 * 
	 */
	class Album
	{
		private $id;
		private $con;
		private $title;
		private $artistId;
		private $languageId;
		private $artworkPath;
		public function __construct($con, $id)
		{
			$this->con=$con;
			$this->id=$id;
			$albumQuery=mysqli_query($this->con,"SELECT * FROM albums WHERE id='".$this->id."'");
			$album=mysqli_fetch_array($albumQuery);
			$this->title=$album['title'];
			$this->artistId=$album['artist'];
			$this->languageId=$album['language'];
			$this->artworkPath=$album['artworkPath'];
		}
		public function getArtist(){

			return (new Artist($this->con, $this->artistId))->getArtist();
		}
		public function getTitle(){

			return $this->title;
		}
		public function getLanguageId(){

			return $this->languageId;
		}

		public function getArtworkPath(){

			return $this->artworkPath;
		}

		public function getSongNum(){

			$query=mysqli_query($this->con,"SELECT id FROM songs WHERE album='".$this->id."'");
			return mysqli_num_rows($query);
		}
		public function getSongIds(){

			$query=mysqli_query($this->con,"SELECT id FROM songs WHERE album='".$this->id."' ORDER BY albumOrder ASC");
			$array=array();
			while ($row=mysqli_fetch_array($query)) {
				array_push($array, $row['id']);
			}

			return $array;
		}

		public function getArtistId(){

			return $this->artistId;
		}
	}
?>