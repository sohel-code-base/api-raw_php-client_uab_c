<?php

class ApplicationReview
{
    private $conn;
    private $user;
    private $table_name = "apps_review";

    private $id;
    private $title;
    private $description;
    private $longDescription;
    private $uniqueUrl;
    private $clientUrl;
    private $logoUrl;
    private $appUrl;
    private $message;
    private $pointsPerInstall;
    private $videoId;
    private $type;
    private $budget;
    private $budgetReserved;
    private $userId;
    private $countries;
    private $rewardFile;
    private $active;
    private $email;

    // constructor with $db as database connection
    public function __construct($db, $user){
        $this->conn = $db;
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * @param mixed $longDescription
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;
    }

    /**
     * @return mixed
     */
    public function getUniqueUrl()
    {
        return $this->uniqueUrl;
    }

    /**
     * @param mixed $uniqueUrl
     */
    public function setUniqueUrl($uniqueUrl)
    {
        $this->uniqueUrl = $uniqueUrl;
    }

    /**
     * @return mixed
     */
    public function getClientUrl()
    {
        return $this->clientUrl;
    }

    /**
     * @param mixed $clientUrl
     */
    public function setClientUrl($clientUrl)
    {
        $this->clientUrl = $clientUrl;
    }

    /**
     * @return mixed
     */
    public function getLogoUrl()
    {
        return $this->logoUrl;
    }

    /**
     * @param mixed $logoUrl
     */
    public function setLogoUrl($logoUrl)
    {
        $this->logoUrl = $logoUrl;
    }

    /**
     * @return mixed
     */
    public function getAppUrl()
    {
        return $this->appUrl;
    }

    /**
     * @param mixed $appUrl
     */
    public function setAppUrl($appUrl)
    {
        $this->appUrl = $appUrl;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getPointsPerInstall()
    {
        return $this->pointsPerInstall;
    }

    /**
     * @param mixed $pointsPerInstall
     */
    public function setPointsPerInstall($pointsPerInstall)
    {
        $this->pointsPerInstall = $pointsPerInstall;
    }

    /**
     * @return mixed
     */
    public function getVideoId()
    {
        return $this->videoId;
    }

    /**
     * @param mixed $videoId
     */
    public function setVideoId($videoId)
    {
        $this->videoId = $videoId;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param mixed $budget
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
    }

    /**
     * @return mixed
     */
    public function getBudgetReserved()
    {
        return $this->budgetReserved;
    }

    /**
     * @param mixed $budgetReserved
     */
    public function setBudgetReserved($budgetReserved)
    {
        $this->budgetReserved = $budgetReserved;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * @param mixed $countries
     */
    public function setCountries($countries)
    {
        $this->countries = $countries;
    }

    /**
     * @return mixed
     */
    public function getRewardFile()
    {
        return $this->rewardFile;
    }

    /**
     * @param mixed $rewardFile
     */
    public function setRewardFile($rewardFile)
    {
        $this->rewardFile = $rewardFile;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function set(array $data)
    {

//        if(array_key_exists('id', $data)){
//            $this->setId($data['id']);
//        }
        if(array_key_exists('title', $data)){
            $this->setTitle($data['title']);
        }
        if(array_key_exists('description', $data)){
            $this->setDescription($data['description']);
        }
        if(array_key_exists('app_url', $data)){
            $this->setAppUrl($data['app_url']);
        }
        if(array_key_exists('logo_url', $data)){
            $this->setLogoUrl($data['logo_url']);
        }
        if(array_key_exists('points', $data)){
            $this->setPointsPerInstall($data['points']);
        }
        if(array_key_exists('budget', $data)){
            $this->setBudget($data['budget']);
        }
        if(array_key_exists('countries', $data)){
            $this->setCountries($data['countries']);
        }

        $this->setUserId($this->user->id);
        $slug = preg_replace('!\s+!', '_', trim($this->getTitle())) . '_' . time();
        $this->setTitle(str_replace('-', ' ', $this->getTitle()));
        $this->setVideoId($slug);
        $this->setType($slug);

        $base_url_page = "https://app.pjani.com/statistics/";
        $hash_user_key = $base_url_page.'user.php?id='.sha1($this->getTitle()).date("Y-m-d-h:i:s");
        $hash_client_key = $base_url_page.'client.php?id='.sha1(strrev($this->getTitle())).date("Y-m-d-h:i:s");
        $this->setUniqueUrl($hash_user_key);
        $this->setClientUrl($hash_client_key);
        $this->setBudgetReserved($this->getBudget());
        $this->setLongDescription("");
        $this->setMessage("");
        $this->setRewardFile("");
        $this->setEmail("");

        return $this;
    }

    public function validate()
    {


        $errors = array();

        if( empty($this->getTitle()) || strlen($this->getTitle()) < 5 || strlen($this->getTitle()) > 100 ){
            $errors["status"] = 422;
            $errors["errors"]["title"] = "Wrong title value!";
        }
        if( empty($this->getDescription()) || strlen($this->getDescription()) < 5 || strlen($this->getDescription()) > 25 ){
            $errors["status"] = 422;
            $errors["errors"]["description"] = "Wrong description value!";

        }
        if( empty($this->getAppUrl()) || strlen($this->getAppUrl()) < 4 || strlen($this->getAppUrl()) > 200 ){
            $errors["status"] = 422;
            $errors["errors"]["app_url"] = "Wrong web url!";

        }
        if( empty($this->getLogoUrl()) || strlen($this->getLogoUrl()) < 4 || strlen($this->getLogoUrl()) > 200 ){
            $errors["status"] = 422;
            $errors["errors"]["logo_url"] = "Wrong image url!";

        }
        if( empty($this->getPointsPerInstall()) || $this->getPointsPerInstall() < 2 || $this->getPointsPerInstall() > 1000 ){
            $errors["status"] = 422;
            $errors["errors"]["points"] = "Wrong points per install value!";

        }

        if( empty($this->getCountries()) || strlen($this->getCountries()) < 2 || strlen($this->getCountries()) > 100 ){
            $errors["status"] = 422;
            $errors["errors"]["countries"] = "Wrong countries value!";

        }



        if ($_SERVER['REQUEST_METHOD'] == 'POST'){ // check for creation

            if( empty($this->getBudget()) || $this->getBudget() < 0 || $this->getBudget() > 10000 ){
                $errors["status"] = 422;
                $errors["errors"]["budget"] = "Wrong budget value!";

            }elseif ($this->getBudget() > $this->user->points){
                $errors["status"] = 422;
                $errors["errors"]["budget"] = "You don't have enough funds!";

            }
        }

        if($errors){
            http_response_code(422);
            echo json_encode($errors);
            exit();
        }

        return true;
    }

    public function create()
    {

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                title=:title, 
                description=:description, 
                unique_url=:unique_url, 
                client_url=:client_url, 
                logo_url=:logo_url, 
                app_url=:app_url, 
                points_per_install=:points_per_install, 
                videoid=:videoid, 
                type=:type, 
                budget=:budget, 
                budget_reserved=:budget_reserved, 
                developer_id=:user_id, 
                countries=:countries,
                long_description=:long_description,
                message=:message,
                reward_file=:reward_file,
                email=:email";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":title", $this->getTitle());
        $stmt->bindParam(":description", $this->getDescription());
        $stmt->bindParam(":unique_url", $this->getUniqueUrl());
        $stmt->bindParam(":client_url", $this->getClientUrl());
        $stmt->bindParam(":logo_url", $this->getLogoUrl());
        $stmt->bindParam(":app_url", $this->getAppUrl());
        $stmt->bindParam(":points_per_install", $this->getPointsPerInstall());
        $stmt->bindParam(":videoid", $this->getVideoId());
        $stmt->bindParam(":type", $this->getType());
        $stmt->bindParam(":budget", $this->getBudget());
        $stmt->bindParam(":budget_reserved", $this->getBudgetReserved());
        $stmt->bindParam(":user_id", $this->getUserId());
        $stmt->bindParam(":countries", $this->getCountries());
        $stmt->bindParam(":long_description", $this->getLongDescription());
        $stmt->bindParam(":message", $this->getMessage());
        $stmt->bindParam(":reward_file", $this->getRewardFile());
        $stmt->bindParam(":email", $this->getEmail());

        // execute query
        if($stmt->execute()){
            $this->updateUser($this->user->points - $this->getBudget());
            // set response code - 201 created
            http_response_code(201);

            // tell the user
            echo json_encode(
                array(
                    "status" => 201,
                    "message" => "created.",
                )
            );
            exit();
        }

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(
            array(
                "status" => 503,
                "message" => "unable to create.",
            )
        );
        exit();
    }
    public function update(){

        // update query
        $query = "UPDATE
                        " . $this->table_name . "
                    SET
                        title=:title, 
                        description=:description, 
                        unique_url=:unique_url, 
                        client_url=:client_url, 
                        logo_url=:logo_url, 
                        app_url=:app_url, 
                        points_per_install=:points_per_install, 
                        countries=:countries
                    WHERE
                        id = :id";
        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":title", $this->getTitle());
        $stmt->bindParam(":description", $this->getDescription());
        $stmt->bindParam(":unique_url", $this->getUniqueUrl());
        $stmt->bindParam(":client_url", $this->getClientUrl());
        $stmt->bindParam(":logo_url", $this->getLogoUrl());
        $stmt->bindParam(":app_url", $this->getAppUrl());
        $stmt->bindParam(":points_per_install", $this->getPointsPerInstall());
        $stmt->bindParam(":countries", $this->getCountries());
        $stmt->bindParam(':id', $this->getId());


        // execute query
        if($stmt->execute()){
            // set response code - 202 updated
            http_response_code(202);

            // tell the user
            echo json_encode(
                array(
                    "status" => 202,
                    "message" => "updated.",
                )
            );
            exit();
        }

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(
            array(
                "status" => 503,
                "message" => "unable to update.",
            )
        );
        exit();
    }



    private function updateUser($updatedBudget)
    {
        // update query
        $query = "UPDATE
                        users
                    SET
                        points = :points
                    WHERE
                        id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind new values
        $stmt->bindParam(':id', $this->user->id);
        $stmt->bindParam(':points', $updatedBudget);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;

    }
}