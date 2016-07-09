<?php


/**
 * Base class that represents a query for the 'users' table.
 *
 *
 *
 * @method usersQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method usersQuery orderByUserName($order = Criteria::ASC) Order by the user_name column
 * @method usersQuery orderByUserFamily($order = Criteria::ASC) Order by the user_family column
 *
 * @method usersQuery groupByUserId() Group by the user_id column
 * @method usersQuery groupByUserName() Group by the user_name column
 * @method usersQuery groupByUserFamily() Group by the user_family column
 *
 * @method usersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method usersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method usersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method users findOne(PropelPDO $con = null) Return the first users matching the query
 * @method users findOneOrCreate(PropelPDO $con = null) Return the first users matching the query, or a new users object populated from the query conditions when no match is found
 *
 * @method users findOneByUserName(string $user_name) Return the first users filtered by the user_name column
 * @method users findOneByUserFamily(string $user_family) Return the first users filtered by the user_family column
 *
 * @method array findByUserId(int $user_id) Return users objects filtered by the user_id column
 * @method array findByUserName(string $user_name) Return users objects filtered by the user_name column
 * @method array findByUserFamily(string $user_family) Return users objects filtered by the user_family column
 *
 * @package    propel.generator.legacyapp.om
 */
abstract class BaseusersQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseusersQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'amin';
        }
        if (null === $modelName) {
            $modelName = 'users';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new usersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   usersQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return usersQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof usersQuery) {
            return $criteria;
        }
        $query = new usersQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   users|users[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = usersPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(usersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 users A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByUserId($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 users A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `user_id`, `user_name`, `user_family` FROM `users` WHERE `user_id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new users();
            $obj->hydrate($row);
            usersPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return users|users[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|users[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return usersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(usersPeer::USER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return usersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(usersPeer::USER_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id >= 12
     * $query->filterByUserId(array('max' => 12)); // WHERE user_id <= 12
     * </code>
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return usersQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(usersPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(usersPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(usersPeer::USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the user_name column
     *
     * Example usage:
     * <code>
     * $query->filterByUserName('fooValue');   // WHERE user_name = 'fooValue'
     * $query->filterByUserName('%fooValue%'); // WHERE user_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return usersQuery The current query, for fluid interface
     */
    public function filterByUserName($userName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userName)) {
                $userName = str_replace('*', '%', $userName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(usersPeer::USER_NAME, $userName, $comparison);
    }

    /**
     * Filter the query on the user_family column
     *
     * Example usage:
     * <code>
     * $query->filterByUserFamily('fooValue');   // WHERE user_family = 'fooValue'
     * $query->filterByUserFamily('%fooValue%'); // WHERE user_family LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userFamily The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return usersQuery The current query, for fluid interface
     */
    public function filterByUserFamily($userFamily = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userFamily)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userFamily)) {
                $userFamily = str_replace('*', '%', $userFamily);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(usersPeer::USER_FAMILY, $userFamily, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   users $users Object to remove from the list of results
     *
     * @return usersQuery The current query, for fluid interface
     */
    public function prune($users = null)
    {
        if ($users) {
            $this->addUsingAlias(usersPeer::USER_ID, $users->getUserId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
