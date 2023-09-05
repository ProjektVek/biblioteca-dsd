require_once 'db_connection.php';

function checkLogin($username, $password){
    $connection = OpenCon();
    
    $query = 'SELECT * FROM Users WHERE username = %s AND password = %s'
    $query = sprintf($query, $username, $password)

    $result = $connection->query($query)
    if($result){
        if($result->numrows > 0){return true;}
        else{return false;}
    }
    else{result $result->error;}
}

function selectAllUsers(){
    $connection = OpenCon();

    $result = $connection->query("SELECT * FROM Users;")
    if($result){
        if($result->numrows > 0){return $result;}
        else{return "Nenhum usuário encontrado";}
    }
    else{result $result->error;}
}

function searchUsers($search){
    $connection = OpenCon();

    $query = 'SELECT * FROM Users WHERE username = %s or name = %s'
    $query = sprintf($query, $search, $search)

    $result = $connection->query("SELECT * FROM Books;")
    if($result){
        if($result->numrows > 0){return $result;}
        else{return "Nenhum usuário encontrado";}
    }
    else{result $result->error;}
}

function selectAllBooks(){
    $connection = OpenCon();

    $result = $connection->query("SELECT * FROM Books;")
    if($result){
        if($result->numrows > 0){return $result;}
        else{return "Nenhum livro encontrado";}
    }
    else{result $result->error;}
}

function searchBooks($search){
    $connection = OpenCon();

    $query = 'SELECT * FROM Books WHERE title = %s or isbn = %s'
    $query = sprintf($query, $search, $search)

    $result = $connection->query("SELECT * FROM Books;")
    if($result){
        if($result->numrows > 0){return $result;}
        else{return "Nenhum livro encontrado";}
    }
    else{result $result->error;}
}