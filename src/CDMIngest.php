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


    }
