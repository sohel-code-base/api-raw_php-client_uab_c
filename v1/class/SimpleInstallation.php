<?php


class SimpleInstallation
{
    private $conn;
    private $user;
    private $table_name = "apps";

    private $id;
    private $title;
    private $description;
    private $logoUrl;
    private $packageName;
    private $message;
    private $points;
    private $videoId;
    private $type;
    private $budget;
    private $userId;
    private $hours;
    private $hoursTillReward;
    private $countries;

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
    public function getPackageName()
    {
        return $this->packageName;
    }

    /**
     * @param mixed $packageName
     */
    public function setPackageName($packageName)
    {
        $this->packageName = $packageName;
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
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param mixed $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
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
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @param mixed $hours
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
    }

    /**
     * @return mixed
     */
    public function getHoursTillReward()
    {
        return $this->hoursTillReward;
    }

    /**
     * @param mixed $hoursTillReward
     */
    public function setHoursTillReward($hoursTillReward)
    {
        $this->hoursTillReward = $hoursTillReward;
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
        if(array_key_exists('logo_url', $data)){
            $this->setLogoUrl($data['logo_url']);
        }
        if(array_key_exists('package_name', $data)){
            $this->setPackageName($data['package_name']);
        }
        if(array_key_exists('message', $data)){
            $this->setMessage($data['message']);
        }
        if(array_key_exists('points', $data)){
            $this->setPoints($data['points']);
        }
        if(array_key_exists('budget', $data)){
            $this->setBudget($data['budget']);
        }
        if(array_key_exists('days', $data)){
            $this->setHours($data['days'] * 24 * 3600000);
        }
        if(array_key_exists('days', $data)){
            $this->setHoursTillReward($data['days']);
        }
        if(array_key_exists('countries', $data)){
            $this->setCountries($data['countries']);
        }else{
            $this->setCountries('all');
        }

        $this->setUserId($this->user->id);
        $slug = preg_replace('!\s+!', '_', trim($this->getTitle())) . '_' . time();
        $this->setTitle(str_replace('-', ' ', $this->getTitle()));
        $this->setVideoId($slug);
        $this->setType($slug);

        return $this;
    }

    public function validate()
    {
        $errors = array();

        if( empty($this->getTitle()) || strlen($this->getTitle()) < 5 || strlen($this->getTitle()) > 100 ){
            $errors["status"] = 422;
            $errors["errors"]["title"] = "Wrong title value!";
        }
        if( empty($this->getDescription()) || strlen($this->getDescription()) < 5 || strlen($this->getDescription()) > 19 ){
            $errors["status"] = 422;
            $errors["errors"]["description"] = "Wrong description value!";

        }
        if( empty($this->getLogoUrl()) || strlen($this->getLogoUrl()) < 4 || strlen($this->getLogoUrl()) > 200 ){
            $errors["status"] = 422;
            $errors["errors"]["logo_url"] = "Wrong logo url!";

        }
        if( empty($this->getPackageName()) || strlen($this->getPackageName()) < 4 || strlen($this->getPackageName()) > 50 ){
            $errors["status"] = 422;
            $errors["errors"]["package_name"] = "Wrong package name!";

        }
        if( empty($this->getMessage()) || strlen($this->getMessage()) < 4 || strlen($this->getMessage()) > 100 ){
            $errors["status"] = 422;
            $errors["errors"]["message"] = "Wrong app message!";

        }
        if( empty($this->getPoints()) || $this->getPoints() < 50 || $this->getPoints() > 1000 ){
            $errors["status"] = 422;
            $errors["errors"]["points"] = "Wrong points per install value!";

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

        if( empty($this->getHours())){
            $errors["status"] = 422;
            $errors["errors"]["days"] = "Wrong days value!";

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
                app_title=:title, 
                app_description=:description, 
                logo_url=:logo_url, 
                package_name=:package_name, 
                app_message=:message, 
                points_per_install=:points, 
                videoid=:videoid, 
                type=:type, 
                budget=:budget, 
                developer_id=:user_id, 
                hours=:hours, 
                hours_till_reward=:hours_till_reward, 
                countries=:countries";

        // prepare query
        $stmt = $this->conn->prepare($query);


        // bind values
        $stmt->bindParam(":title", $this->getTitle());
        $stmt->bindParam(":description", $this->getDescription());
        $stmt->bindParam(":logo_url", $this->getLogoUrl());
        $stmt->bindParam(":package_name", $this->getPackageName());
        $stmt->bindParam(":message", $this->getMessage());
        $stmt->bindParam(":points", $this->getPoints());
        $stmt->bindParam(":videoid", $this->getVideoId());
        $stmt->bindParam(":type", $this->getType());
        $stmt->bindParam(":budget", $this->getBudget());
        $stmt->bindParam(":user_id", $this->user->id);
        $stmt->bindParam(":hours", $this->getHours());
        $stmt->bindParam(":hours_till_reward", $this->getHoursTillReward());
        $stmt->bindParam(":countries", $this->getCountries());

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
                        app_title=:title, 
                        app_description=:description, 
                        logo_url=:logo_url, 
                        package_name=:package_name, 
                        app_message=:message, 
                        points_per_install=:points, 
                        hours=:hours, 
                        hours_till_reward=:hours_till_reward
                    WHERE
                        id = :id";
        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":title", $this->getTitle());
        $stmt->bindParam(":description", $this->getDescription());
        $stmt->bindParam(":logo_url", $this->getLogoUrl());
        $stmt->bindParam(":package_name", $this->getPackageName());
        $stmt->bindParam(":message", $this->getMessage());
        $stmt->bindParam(":points", $this->getPoints());
        $stmt->bindParam(":hours", $this->getHours());
        $stmt->bindParam(":hours_till_reward", $this->getHoursTillReward());
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