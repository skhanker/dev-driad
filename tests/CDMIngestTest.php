<?php

    include __DIR__  . "/../src/CDMIngest.php";

    class CDMIngestTest extends PHPUnit_Framework_TestCase
	{

        /**
         * @var $model CDMIngest
         */
        private $model;

		public function setUpBeforeClass()
		{
			fwrite(STDOUT, __METHOD__ . "\n");
			fwrite(STDOUT, "Creating Model\n");
            $this->model = new CDMIngest('{    "_id": "DL UID",    "_type": "DL TYPE: ITEM",    "_compound": "IS COMPOUND OBJ? (t/f)",    "_created": "DL INGEST TIMESTAMP",    "_updated": "DL UPDATED TIMESTAMP",    "_thumb": "THUMBNAIL URL",    "_theme": "THEME",    "_mediaHandler": "MEDIA HANDLER",    "sourceResource": {        "@type": "edm:ProvidedCHO",        "sourceID": "ID (original)",        "title": {            "eng": "TITLE",            "jap": "JAPANESE TITLE"        },        "creator": "CREATOR",        "contributor": "CONTRIBUTOR",        "publisher": "PUBLISHER",        "description": "DESCRIPTION",        "subject": [            {                "name": "SUBJECT NAME"            },            {                "name": "SUBJECT NAME"            }        ],        "extent": "EXTENT",        "collection": "SOURCE COLLECTION",        "format": "FORMAT",        "type": "TYPE",        "genre": "GENRE",        "temporal": {            "date": "DATE",            "sort": "SORT",            "decade": "DECADE"        },        "source": {            "@id": "URI?",            "name": "SOURCE NAME"        },        "rights": "SOURCE RIGHTS",        "geo": {            "name": "GEO NAME",            "latLong": "LAT/LONG"        }    },    "webResource": {        "@type": "edm:WebResource",        "@id": "WEBRESOURCE ID",        "format": "FORMAT",        "rights": "WEB OBJECT RIGHTS",        "type": "DCMITYPE",        "collection": "COLLECTION",        "hasPart": [            "PAGE 1 URL",            "PAGE 2 URL",            "PAGE etc. URL"        ]    },    "originalRecord": "ORIGINAL RECORD"}');
		}

		protected function setUp()
		{
			// fwrite(STDOUT, "\n\n" . __METHOD__ . "\n");
		}

		protected function assertPreConditions()
		{
			//fwrite(STDOUT, __METHOD__ . "\n");
		}

		protected function assertPostConditions()
		{
			//fwrite(STDOUT, __METHOD__ . "\n");
		}

		protected function tearDown()
		{
			//fwrite(STDOUT, __METHOD__ . "\n");
		}

		public static function tearDownAfterClass()
		{
			fwrite(STDOUT, "\n" . __METHOD__ . "\n");
		}


        /**
         * @dataProvider modelProvider
         */
        public function testGetModelAsArray($m)
        {
            $this->assertInternalType('array', $m);
        }

        /**
         * @depends testGetModelAsArray
         * @dataProvider modelProvider
         */
        public function testModelLength(array $m)
        {
            $this->assertCount($this->model->getModelLength(), $m);
        }

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedID(array $m)
		{
			$this->assertArrayHasKey('_id',$m);
		}

		/**
		 * @depends testReservedID
		 * @dataProvider modelProvider
		 */

		public function testReservedIDInternalType($m)
		{
			$this->assertInternalType('string', $m['_id']);
		}

		/**
		 * @depends testReservedIDInternalType
		 * @dataProvider modelProvider
		 */

		public function testReservedIDFormat($m)
		{
			$this->assertRegExp('/[a-z]+[-_\.\s]?[a-z]+[-_\.\s]?[a-z0-9]{1,9}/i', $m['_id'], "Expected string in format [a-z]+-[a-z]+-?[0-9]{1,9} but got {$m['_id']}");
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedType($m)
		{
			$this->assertArrayHasKey('_type',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedCompund($m)
		{
			$this->assertArrayHasKey('_compound',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedCreated($m)
		{
			$this->assertArrayHasKey('_created',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedUpdated($m)
		{
			$this->assertArrayHasKey('_updated',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedThumb($m)
		{
			$this->assertArrayHasKey('_thumb',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedTheme($m)
		{
			$this->assertArrayHasKey('_theme',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedMediaHandler($m)
		{
			$this->assertArrayHasKey('_mediaHandler',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testSourceResource($m)
		{
			$this->assertArrayHasKey('sourceResource',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testWebResource($m)
		{
			$this->assertArrayHasKey('webResource',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testOriginalRecord($m)
		{
			$this->assertArrayHasKey('originalRecord',$m);
		}


		public function modelProvider()
		{
			$arr = array();
			$mod = $this->model->getModelAsArray();
			foreach ($mod as $k => $v){
				$arr[$k] = $v;
			}
			return array(
				array($arr)
			);
		}
	}