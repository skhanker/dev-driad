<?php
	class CDMIngestTest extends PHPUnit_Framework_TestCase
	{

		protected $model = '{
    "_id": "DL UID",
    "_type": "DL TYPE: ITEM",
    "_compound": "IS COMPOUND OBJ? (t/f)",
    "_created": "DL INGEST TIMESTAMP",
    "_updated": "DL UPDATED TIMESTAMP",
    "_thumb": "THUMBNAIL URL",
    "_theme": "THEME",
    "_mediaHandler": "MEDIA HANDLER",
    "sourceResource": {
        "@type": "edm:ProvidedCHO",
        "sourceID": "ID (original)",
        "title": {
            "eng": "TITLE",
            "jap": "JAPANESE TITLE"
        },
        "creator": "CREATOR",
        "contributor": "CONTRIBUTOR",
        "publisher": "PUBLISHER",
        "description": "DESCRIPTION",
        "subject": [
            {
                "name": "SUBJECT NAME"
            },
            {
                "name": "SUBJECT NAME"
            }
        ],
        "extent": "EXTENT",
        "collection": "SOURCE COLLECTION",
        "format": "FORMAT",
        "type": "TYPE",
        "genre": "GENRE",
        "temporal": {
            "date": "DATE",
            "sort": "SORT",
            "decade": "DECADE"
        },
        "source": {
            "@id": "URI?",
            "name": "SOURCE NAME"
        },
        "rights": "SOURCE RIGHTS",
        "geo": {
            "name": "GEO NAME",
            "latLong": "LAT/LONG"
        }
    },
    "webResource": {
        "@type": "edm:WebResource",
        "@id": "WEBRESOURCE ID",
        "format": "FORMAT",
        "rights": "WEB OBJECT RIGHTS",
        "type": "DCMITYPE",
        "collection": "COLLECTION",
        "hasPart": [
            "PAGE 1 URL",
            "PAGE 2 URL",
            "PAGE etc. URL"
        ]
    },
    "originalRecord": "ORIGINAL RECORD"
}';

		public static function setUpBeforeClass()
		{
			fwrite(STDOUT, __METHOD__ . "\n");
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

		protected function onNotSuccessfulTest(Exception $e)
		{
			//fwrite(STDOUT, "\n" . __METHOD__ . "\n");
			throw $e;
		}



		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedID(array $m)
		{
			$this->assertArrayHasKey('--id',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedType(array $m)
		{
			$this->assertArrayHasKey('_type',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedCompund(array $m)
		{
			$this->assertArrayHasKey('_compound',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedCreated(array $m)
		{
			$this->assertArrayHasKey('_created',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedUpdated(array $m)
		{
			$this->assertArrayHasKey('_updated',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedThumb(array $m)
		{
			$this->assertArrayHasKey('_thumb',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedTheme(array $m)
		{
			$this->assertArrayHasKey('_theme',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testReservedMediaHandler(array $m)
		{
			$this->assertArrayHasKey('_mediaHandler',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testSourceResource(array $m)
		{
			$this->assertArrayHasKey('sourceResource',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testWebResource(array $m)
		{
			$this->assertArrayHasKey('webResource',$m);
		}

		/**
		 * @dataProvider modelProvider
		 */
		public function testOriginalRecord(array $m)
		{
			$this->assertArrayHasKey('originalRecord',$m);
		}


		public function modelProvider()
		{
			$arr = array();
			$json = json_decode($this->model,true);
			foreach ($json as $k => $v){
				$arr[$k] = $v;
			}
			return array(
				array($arr)
			);
		}
	}
?>
