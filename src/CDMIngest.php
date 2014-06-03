<?php

    /**
     * Class CDMIngest
     */
    class CDMIngest
    {
        /**
         * @var
         */
        private $model;

        /**
         * @var int
         */
        private $modelLength = 11;

        /**
         * @return int
         */
        public function getModelLength()
        {
            return $this->modelLength;
        }

        /**
         * @param $model
         */
        function __construct($model)
        {
            $this->model = $model;
        }

        /**
         * @param string $model
         */
        public function setModel($model)
        {
            $this->model = $model;
        }

        /**
         * @return string
         */
        public function getModel()
        {
            return $this->model;
        }

        /**
         * @return array
         */
        public function getModelAsArray()
        {
            return json_decode($this->model, true);
        }


    }
