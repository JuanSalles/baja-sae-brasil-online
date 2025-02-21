<?php

namespace Baja\Model\Base;

use \Exception;
use \PDO;
use Baja\Model\Tournament as ChildTournament;
use Baja\Model\TournamentQuery as ChildTournamentQuery;
use Baja\Model\Map\TournamentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'tournament' table.
 *
 *
 *
 * @method     ChildTournamentQuery orderByEventoId($order = Criteria::ASC) Order by the evento_id column
 * @method     ChildTournamentQuery orderByProvaId($order = Criteria::ASC) Order by the prova_id column
 * @method     ChildTournamentQuery orderByMatchId($order = Criteria::ASC) Order by the match_id column
 * @method     ChildTournamentQuery orderByround($order = Criteria::ASC) Order by the round column
 * @method     ChildTournamentQuery orderByEquipe1Id($order = Criteria::ASC) Order by the equipe1_id column
 * @method     ChildTournamentQuery orderByEquipe2Id($order = Criteria::ASC) Order by the equipe2_id column
 * @method     ChildTournamentQuery orderByWinner($order = Criteria::ASC) Order by the winner column
 * @method     ChildTournamentQuery orderByDados($order = Criteria::ASC) Order by the dados column
 *
 * @method     ChildTournamentQuery groupByEventoId() Group by the evento_id column
 * @method     ChildTournamentQuery groupByProvaId() Group by the prova_id column
 * @method     ChildTournamentQuery groupByMatchId() Group by the match_id column
 * @method     ChildTournamentQuery groupByround() Group by the round column
 * @method     ChildTournamentQuery groupByEquipe1Id() Group by the equipe1_id column
 * @method     ChildTournamentQuery groupByEquipe2Id() Group by the equipe2_id column
 * @method     ChildTournamentQuery groupByWinner() Group by the winner column
 * @method     ChildTournamentQuery groupByDados() Group by the dados column
 *
 * @method     ChildTournamentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTournamentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTournamentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTournamentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTournamentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTournamentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTournamentQuery leftJoinProva($relationAlias = null) Adds a LEFT JOIN clause to the query using the Prova relation
 * @method     ChildTournamentQuery rightJoinProva($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Prova relation
 * @method     ChildTournamentQuery innerJoinProva($relationAlias = null) Adds a INNER JOIN clause to the query using the Prova relation
 *
 * @method     ChildTournamentQuery joinWithProva($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Prova relation
 *
 * @method     ChildTournamentQuery leftJoinWithProva() Adds a LEFT JOIN clause and with to the query using the Prova relation
 * @method     ChildTournamentQuery rightJoinWithProva() Adds a RIGHT JOIN clause and with to the query using the Prova relation
 * @method     ChildTournamentQuery innerJoinWithProva() Adds a INNER JOIN clause and with to the query using the Prova relation
 *
 * @method     ChildTournamentQuery leftJoinEquipe($relationAlias = null) Adds a LEFT JOIN clause to the query using the Equipe relation
 * @method     ChildTournamentQuery rightJoinEquipe($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Equipe relation
 * @method     ChildTournamentQuery innerJoinEquipe($relationAlias = null) Adds a INNER JOIN clause to the query using the Equipe relation
 *
 * @method     ChildTournamentQuery joinWithEquipe($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Equipe relation
 *
 * @method     ChildTournamentQuery leftJoinWithEquipe() Adds a LEFT JOIN clause and with to the query using the Equipe relation
 * @method     ChildTournamentQuery rightJoinWithEquipe() Adds a RIGHT JOIN clause and with to the query using the Equipe relation
 * @method     ChildTournamentQuery innerJoinWithEquipe() Adds a INNER JOIN clause and with to the query using the Equipe relation
 *
 * @method     \Baja\Model\ProvaQuery|\Baja\Model\EquipeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTournament findOne(ConnectionInterface $con = null) Return the first ChildTournament matching the query
 * @method     ChildTournament findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTournament matching the query, or a new ChildTournament object populated from the query conditions when no match is found
 *
 * @method     ChildTournament findOneByEventoId(string $evento_id) Return the first ChildTournament filtered by the evento_id column
 * @method     ChildTournament findOneByProvaId(string $prova_id) Return the first ChildTournament filtered by the prova_id column
 * @method     ChildTournament findOneByMatchId(int $match_id) Return the first ChildTournament filtered by the match_id column
 * @method     ChildTournament findOneByround(string $round) Return the first ChildTournament filtered by the round column
 * @method     ChildTournament findOneByEquipe1Id(string $equipe1_id) Return the first ChildTournament filtered by the equipe1_id column
 * @method     ChildTournament findOneByEquipe2Id(string $equipe2_id) Return the first ChildTournament filtered by the equipe2_id column
 * @method     ChildTournament findOneByWinner(int $winner) Return the first ChildTournament filtered by the winner column
 * @method     ChildTournament findOneByDados(string $dados) Return the first ChildTournament filtered by the dados column *

 * @method     ChildTournament requirePk($key, ConnectionInterface $con = null) Return the ChildTournament by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTournament requireOne(ConnectionInterface $con = null) Return the first ChildTournament matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTournament requireOneByEventoId(string $evento_id) Return the first ChildTournament filtered by the evento_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTournament requireOneByProvaId(string $prova_id) Return the first ChildTournament filtered by the prova_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTournament requireOneByMatchId(int $match_id) Return the first ChildTournament filtered by the match_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTournament requireOneByround(string $round) Return the first ChildTournament filtered by the round column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTournament requireOneByEquipe1Id(string $equipe1_id) Return the first ChildTournament filtered by the equipe1_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTournament requireOneByEquipe2Id(string $equipe2_id) Return the first ChildTournament filtered by the equipe2_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTournament requireOneByWinner(int $winner) Return the first ChildTournament filtered by the winner column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTournament requireOneByDados(string $dados) Return the first ChildTournament filtered by the dados column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTournament[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTournament objects based on current ModelCriteria
 * @method     ChildTournament[]|ObjectCollection findByEventoId(string $evento_id) Return ChildTournament objects filtered by the evento_id column
 * @method     ChildTournament[]|ObjectCollection findByProvaId(string $prova_id) Return ChildTournament objects filtered by the prova_id column
 * @method     ChildTournament[]|ObjectCollection findByMatchId(int $match_id) Return ChildTournament objects filtered by the match_id column
 * @method     ChildTournament[]|ObjectCollection findByround(string $round) Return ChildTournament objects filtered by the round column
 * @method     ChildTournament[]|ObjectCollection findByEquipe1Id(string $equipe1_id) Return ChildTournament objects filtered by the equipe1_id column
 * @method     ChildTournament[]|ObjectCollection findByEquipe2Id(string $equipe2_id) Return ChildTournament objects filtered by the equipe2_id column
 * @method     ChildTournament[]|ObjectCollection findByWinner(int $winner) Return ChildTournament objects filtered by the winner column
 * @method     ChildTournament[]|ObjectCollection findByDados(string $dados) Return ChildTournament objects filtered by the dados column
 * @method     ChildTournament[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TournamentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Baja\Model\Base\TournamentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'resultados', $modelName = '\\Baja\\Model\\Tournament', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTournamentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTournamentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTournamentQuery) {
            return $criteria;
        }
        $query = new ChildTournamentQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array[$evento_id, $prova_id, $match_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTournament|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TournamentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TournamentTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]))))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTournament A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT evento_id, prova_id, match_id, round, equipe1_id, equipe2_id, winner, dados FROM tournament WHERE evento_id = :p0 AND prova_id = :p1 AND match_id = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTournament $obj */
            $obj = new ChildTournament();
            $obj->hydrate($row);
            TournamentTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildTournament|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(TournamentTableMap::COL_EVENTO_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(TournamentTableMap::COL_PROVA_ID, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(TournamentTableMap::COL_MATCH_ID, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(TournamentTableMap::COL_EVENTO_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(TournamentTableMap::COL_PROVA_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(TournamentTableMap::COL_MATCH_ID, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the evento_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEventoId('fooValue');   // WHERE evento_id = 'fooValue'
     * $query->filterByEventoId('%fooValue%', Criteria::LIKE); // WHERE evento_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $eventoId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByEventoId($eventoId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eventoId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TournamentTableMap::COL_EVENTO_ID, $eventoId, $comparison);
    }

    /**
     * Filter the query on the prova_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProvaId('fooValue');   // WHERE prova_id = 'fooValue'
     * $query->filterByProvaId('%fooValue%', Criteria::LIKE); // WHERE prova_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $provaId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByProvaId($provaId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($provaId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TournamentTableMap::COL_PROVA_ID, $provaId, $comparison);
    }

    /**
     * Filter the query on the match_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMatchId(1234); // WHERE match_id = 1234
     * $query->filterByMatchId(array(12, 34)); // WHERE match_id IN (12, 34)
     * $query->filterByMatchId(array('min' => 12)); // WHERE match_id > 12
     * </code>
     *
     * @param     mixed $matchId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByMatchId($matchId = null, $comparison = null)
    {
        if (is_array($matchId)) {
            $useMinMax = false;
            if (isset($matchId['min'])) {
                $this->addUsingAlias(TournamentTableMap::COL_MATCH_ID, $matchId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($matchId['max'])) {
                $this->addUsingAlias(TournamentTableMap::COL_MATCH_ID, $matchId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TournamentTableMap::COL_MATCH_ID, $matchId, $comparison);
    }

    /**
     * Filter the query on the round column
     *
     * Example usage:
     * <code>
     * $query->filterByround('fooValue');   // WHERE round = 'fooValue'
     * $query->filterByround('%fooValue%', Criteria::LIKE); // WHERE round LIKE '%fooValue%'
     * </code>
     *
     * @param     string $round The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByround($round = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($round)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TournamentTableMap::COL_ROUND, $round, $comparison);
    }

    /**
     * Filter the query on the equipe1_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEquipe1Id('fooValue');   // WHERE equipe1_id = 'fooValue'
     * $query->filterByEquipe1Id('%fooValue%', Criteria::LIKE); // WHERE equipe1_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $equipe1Id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByEquipe1Id($equipe1Id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($equipe1Id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TournamentTableMap::COL_EQUIPE1_ID, $equipe1Id, $comparison);
    }

    /**
     * Filter the query on the equipe2_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEquipe2Id('fooValue');   // WHERE equipe2_id = 'fooValue'
     * $query->filterByEquipe2Id('%fooValue%', Criteria::LIKE); // WHERE equipe2_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $equipe2Id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByEquipe2Id($equipe2Id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($equipe2Id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TournamentTableMap::COL_EQUIPE2_ID, $equipe2Id, $comparison);
    }

    /**
     * Filter the query on the winner column
     *
     * Example usage:
     * <code>
     * $query->filterByWinner(1234); // WHERE winner = 1234
     * $query->filterByWinner(array(12, 34)); // WHERE winner IN (12, 34)
     * $query->filterByWinner(array('min' => 12)); // WHERE winner > 12
     * </code>
     *
     * @see       filterByEquipe()
     *
     * @param     mixed $winner The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByWinner($winner = null, $comparison = null)
    {
        if (is_array($winner)) {
            $useMinMax = false;
            if (isset($winner['min'])) {
                $this->addUsingAlias(TournamentTableMap::COL_WINNER, $winner['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($winner['max'])) {
                $this->addUsingAlias(TournamentTableMap::COL_WINNER, $winner['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TournamentTableMap::COL_WINNER, $winner, $comparison);
    }

    /**
     * Filter the query on the dados column
     *
     * Example usage:
     * <code>
     * $query->filterByDados('fooValue');   // WHERE dados = 'fooValue'
     * $query->filterByDados('%fooValue%', Criteria::LIKE); // WHERE dados LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dados The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByDados($dados = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dados)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TournamentTableMap::COL_DADOS, $dados, $comparison);
    }

    /**
     * Filter the query by a related \Baja\Model\Prova object
     *
     * @param \Baja\Model\Prova $prova The related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByProva($prova, $comparison = null)
    {
        if ($prova instanceof \Baja\Model\Prova) {
            return $this
                ->addUsingAlias(TournamentTableMap::COL_EVENTO_ID, $prova->getEventoId(), $comparison)
                ->addUsingAlias(TournamentTableMap::COL_PROVA_ID, $prova->getProvaId(), $comparison);
        } else {
            throw new PropelException('filterByProva() only accepts arguments of type \Baja\Model\Prova');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Prova relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function joinProva($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Prova');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Prova');
        }

        return $this;
    }

    /**
     * Use the Prova relation Prova object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Baja\Model\ProvaQuery A secondary query class using the current class as primary query
     */
    public function useProvaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProva($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Prova', '\Baja\Model\ProvaQuery');
    }

    /**
     * Filter the query by a related \Baja\Model\Equipe object
     *
     * @param \Baja\Model\Equipe $equipe The related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTournamentQuery The current query, for fluid interface
     */
    public function filterByEquipe($equipe, $comparison = null)
    {
        if ($equipe instanceof \Baja\Model\Equipe) {
            return $this
                ->addUsingAlias(TournamentTableMap::COL_EVENTO_ID, $equipe->getEventoId(), $comparison)
                ->addUsingAlias(TournamentTableMap::COL_WINNER, $equipe->getEquipeId(), $comparison);
        } else {
            throw new PropelException('filterByEquipe() only accepts arguments of type \Baja\Model\Equipe');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Equipe relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function joinEquipe($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Equipe');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Equipe');
        }

        return $this;
    }

    /**
     * Use the Equipe relation Equipe object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Baja\Model\EquipeQuery A secondary query class using the current class as primary query
     */
    public function useEquipeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEquipe($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Equipe', '\Baja\Model\EquipeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTournament $tournament Object to remove from the list of results
     *
     * @return $this|ChildTournamentQuery The current query, for fluid interface
     */
    public function prune($tournament = null)
    {
        if ($tournament) {
            $this->addCond('pruneCond0', $this->getAliasedColName(TournamentTableMap::COL_EVENTO_ID), $tournament->getEventoId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(TournamentTableMap::COL_PROVA_ID), $tournament->getProvaId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(TournamentTableMap::COL_MATCH_ID), $tournament->getMatchId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tournament table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TournamentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TournamentTableMap::clearInstancePool();
            TournamentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TournamentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TournamentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TournamentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TournamentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TournamentQuery
