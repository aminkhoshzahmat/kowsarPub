<?php


/**
 * Base class that represents a query for the 'admins' table.
 *
 *
 *
 * @method adminsQuery orderByAdminId($order = Criteria::ASC) Order by the admin_id column
 * @method adminsQuery orderByAdminName($order = Criteria::ASC) Order by the admin_name column
 * @method adminsQuery orderByAdminFamily($order = Criteria::ASC) Order by the admin_family column
 *
 * @method adminsQuery groupByAdminId() Group by the admin_id column
 * @method adminsQuery groupByAdminName() Group by the admin_name column
 * @method adminsQuery groupByAdminFamily() Group by the admin_family column
 *
 * @method adminsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method adminsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method adminsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method admins findOne(PropelPDO $con = null) Return the first admins matching the query
 * @method admins findOneOrCreate(PropelPDO $con = null) Return the first admins matching the query, or a new admins object populated from the query conditions when no match is found
 *
 * @method admins findOneByAdminName(string $admin_name) Return the first admins filtered by the admin_name column
 * @method admins findOneByAdminFamily(string $admin_family) Return the first admins filtered by the admin_family column
 *
 * @method array findByAdminId(int $admin_id) Return admins objects filtered by the admin_id column
 * @method array findByAdminName(string $admin_name) Return admins objects filtered by the admin_name column
 * @method array findByAdminFamily(string $admin_family) Return admins objects filtered by the admin_family column
 *
 * @package    propel.generator.legacyapp.om
 */
abstract class BaseadminsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseadminsQuery object.
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
            $modelName = 'admins';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new adminsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   adminsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return adminsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof adminsQuery) {
            return $criteria;
        }
        $query = new adminsQuery(null, null, $modelAlias);

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
     * @return   admins|admins[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = adminsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(adminsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 admins A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByAdminId($key, $con = null)
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
     * @return                 admins A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `admin_id`, `admin_name`, `admin_family` FROM `admins` WHERE `admin_id` = :p0';
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
            $obj = new admins();
            $obj->hydrate($row);
            adminsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return admins|admins[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|admins[]|mixed the list of results, formatted by the current formatter
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
     * @return adminsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(adminsPeer::ADMIN_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return adminsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(adminsPeer::ADMIN_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the admin_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAdminId(1234); // WHERE admin_id = 1234
     * $query->filterByAdminId(array(12, 34)); // WHERE admin_id IN (12, 34)
     * $query->filterByAdminId(array('min' => 12)); // WHERE admin_id >= 12
     * $query->filterByAdminId(array('max' => 12)); // WHERE admin_id <= 12
     * </code>
     *
     * @param     mixed $adminId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return adminsQuery The current query, for fluid interface
     */
    public function filterByAdminId($adminId = null, $comparison = null)
    {
        if (is_array($adminId)) {
            $useMinMax = false;
            if (isset($adminId['min'])) {
                $this->addUsingAlias(adminsPeer::ADMIN_ID, $adminId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($adminId['max'])) {
                $this->addUsingAlias(adminsPeer::ADMIN_ID, $adminId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(adminsPeer::ADMIN_ID, $adminId, $comparison);
    }

    /**
     * Filter the query on the admin_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAdminName('fooValue');   // WHERE admin_name = 'fooValue'
     * $query->filterByAdminName('%fooValue%'); // WHERE admin_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $adminName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return adminsQuery The current query, for fluid interface
     */
    public function filterByAdminName($adminName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($adminName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $adminName)) {
                $adminName = str_replace('*', '%', $adminName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(adminsPeer::ADMIN_NAME, $adminName, $comparison);
    }

    /**
     * Filter the query on the admin_family column
     *
     * Example usage:
     * <code>
     * $query->filterByAdminFamily('fooValue');   // WHERE admin_family = 'fooValue'
     * $query->filterByAdminFamily('%fooValue%'); // WHERE admin_family LIKE '%fooValue%'
     * </code>
     *
     * @param     string $adminFamily The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return adminsQuery The current query, for fluid interface
     */
    public function filterByAdminFamily($adminFamily = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($adminFamily)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $adminFamily)) {
                $adminFamily = str_replace('*', '%', $adminFamily);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(adminsPeer::ADMIN_FAMILY, $adminFamily, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   admins $admins Object to remove from the list of results
     *
     * @return adminsQuery The current query, for fluid interface
     */
    public function prune($admins = null)
    {
        if ($admins) {
            $this->addUsingAlias(adminsPeer::ADMIN_ID, $admins->getAdminId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
