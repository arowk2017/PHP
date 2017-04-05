<?php 

class mysqliRow
{
    public $sql, $nCols;
    

function getResult($sql)
{
    $metadata = mysqli_stmt_result_metadata($sql);
    $ret = new mysqliRow;
    if (!$ret) return NULL;

    $ret->nCols = mysqli_num_fields($metadata);
    $ret->sql = $sql;

    mysqli_free_result($metadata);
    return $ret;
}

function fetchArray(&$result)
{
    $ret = array();
    $code = "return mysqli_stmt_bind_result(\$result->sql ";

    for ($i=0; $i<$result->nCols; $i++)
    {
        $ret[$i] = NULL;
        $code .= ", \$ret['" .$i ."']";
    };

    $code .= ");";
    if (!eval($code)) { return NULL; };

    if (!mysqli_stmt_fetch($result->sql)) { return NULL; };

    return $ret;
}

}
?>
