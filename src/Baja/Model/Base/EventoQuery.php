<?php

namespace Baja\Model\Base;

use \Exception;
use \PDO;
use Baja\Model\Evento as ChildEvento;
use Baja\Model\EventoQuery as ChildEventoQuery;
use Baja\Model\Map\EventoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'evento' table.
 *
 *
 *
 * @method     ChildEventoQuery orderByEventoId($order = Criteria::ASC) Order by the evento_id column
 * @method     ChildEventoQuery orderByTitulo($order = Criteria::ASC) Order by the titulo column
 * @method     ChildEventoQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildEventoQuery orderByTipo($order = Criteria::ASC) Order by the tipo column
 * @method     ChildEventoQuery orderByAno($order = Criteria::ASC) Order by the ano column
 * @method     ChildEventoQuery orderByMenu($order = Criteria::ASC) Order by the menu column
 * @method     ChildEventoQuery orderByAtivo($order = Criteria::ASC) Order by the ativo column
 * @method     ChildEventoQuery orderByFinalizado($order = Criteria::ASC) Order by the finalizado column
 * @method     ChildEventoQuery orderBySpoilers($order = Criteria::ASC) Order by the spoilers column
 * @method     ChildEventoQuery orderByTemCertificado($order = Criteria::ASC) Order by the tem_certificado column
 * @method     ChildEventoQuery orderByPresidente($order = Criteria::ASC) Order by the presidente column
 * @method     ChildEventoQuery orderByData($order = Criteria::ASC) Order by the data column
 * @method     ChildEventoQuery orderByMandatoPresidente($order = Criteria::ASC) Order by the mandato_presidente column
 * @method     ChildEventoQuery orderByLocal($order = Criteria::ASC) Order by the local column
 * @method     ChildEventoQuery orderByEmAndamento($order = Criteria::ASC) Order by the em_andamento column
 *
 * @method     ChildEventoQuery groupByEventoId() Group by the evento_id column
 * @method     ChildEventoQuery groupByTitulo() Group by the titulo column
 * @method     ChildEventoQuery groupByNome() Group by the nome column
 * @method     ChildEventoQuery groupByTipo() Group by the tipo column
 * @method     ChildEventoQuery groupByAno() Group by the ano column
 * @method     ChildEventoQuery groupByMenu() Group by the menu column
 * @method     ChildEventoQuery groupByAtivo() Group by the ativo column
 * @method     ChildEventoQuery groupByFinalizado() Group by the finalizado column
 * @method     ChildEventoQuery groupBySpoilers() Group by the spoilers column
 * @method     ChildEventoQuery groupByTemCertificado() Group by the tem_certificado column
 * @method     ChildEventoQuery groupByPresidente() Group by the presidente column
 * @method     ChildEventoQuery groupByData() Group by the data column
 * @method     ChildEventoQuery groupByMandatoPresidente() Group by the mandato_presidente column
 * @method     ChildEventoQuery groupByLocal() Group by the local column
 * @method     ChildEventoQuery groupByEmAndamento() Group by the em_andamento column
 *
 * @method     ChildEventoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEventoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEventoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEventoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEventoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEventoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEventoQuery leftJoinEquipe($relationAlias = null) Adds a LEFT JOIN clause to the query using the Equipe relation
 * @method     ChildEventoQuery rightJoinEquipe($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Equipe relation
 * @method     ChildEventoQuery innerJoinEquipe($relationAlias = null) Adds a INNER JOIN clause to the query using the Equipe relation
 *
 * @method     ChildEventoQuery joinWithEquipe($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Equipe relation
 *
 * @method     ChildEventoQuery leftJoinWithEquipe() Adds a LEFT JOIN clause and with to the query using the Equipe relation
 * @method     ChildEventoQuery rightJoinWithEquipe() Adds a RIGHT JOIN clause and with to the query using the Equipe relation
 * @method     ChildEventoQuery innerJoinWithEquipe() Adds a INNER JOIN clause and with to the query using the Equipe relation
 *
 * @method     ChildEventoQuery leftJoinParticipante($relationAlias = null) Adds a LEFT JOIN clause to the query using the Participante relation
 * @method     ChildEventoQuery rightJoinParticipante($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Participante relation
 * @method     ChildEventoQuery innerJoinParticipante($relationAlias = null) Adds a INNER JOIN clause to the query using the Participante relation
 *
 * @method     ChildEventoQuery joinWithParticipante($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Participante relation
 *
 * @method     ChildEventoQuery leftJoinWithParticipante() Adds a LEFT JOIN clause and with to the query using the Participante relation
 * @method     ChildEventoQuery rightJoinWithParticipante() Adds a RIGHT JOIN clause and with to the query using the Participante relation
 * @method     ChildEventoQuery innerJoinWithParticipante() Adds a INNER JOIN clause and with to the query using the Participante relation
 *
 * @method     ChildEventoQuery leftJoinProva($relationAlias = null) Adds a LEFT JOIN clause to the query using the Prova relation
 * @method     ChildEventoQuery rightJoinProva($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Prova relation
 * @method     ChildEventoQuery innerJoinProva($relationAlias = null) Adds a INNER JOIN clause to the query using the Prova relation
 *
 * @method     ChildEventoQuery joinWithProva($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Prova relation
 *
 * @method     ChildEventoQuery leftJoinWithProva() Adds a LEFT JOIN clause and with to the query using the Prova relation
 * @method     ChildEventoQuery rightJoinWithProva() Adds a RIGHT JOIN clause and with to the query using the Prova relation
 * @method     ChildEventoQuery innerJoinWithProva() Adds a INNER JOIN clause and with to the query using the Prova relation
 *
 * @method     ChildEventoQuery leftJoinResultado($relationAlias = null) Adds a LEFT JOIN clause to the query using the Resultado relation
 * @method     ChildEventoQuery rightJoinResultado($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Resultado relation
 * @method     ChildEventoQuery innerJoinResultado($relationAlias = null) Adds a INNER JOIN clause to the query using the Resultado relation
 *
 * @method     ChildEventoQuery joinWithResultado($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Resultado relation
 *
 * @method     ChildEventoQuery leftJoinWithResultado() Adds a LEFT JOIN clause and with to the query using the Resultado relation
 * @method     ChildEventoQuery rightJoinWithResultado() Adds a RIGHT JOIN clause and with to the query using the Resultado relation
 * @method     ChildEventoQuery innerJoinWithResultado() Adds a INNER JOIN clause and with to the query using the Resultado relation
 *
 * @method     ChildEventoQuery leftJoinFila($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fila relation
 * @method     ChildEventoQuery rightJoinFila($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fila relation
 * @method     ChildEventoQuery innerJoinFila($relationAlias = null) Adds a INNER JOIN clause to the query using the Fila relation
 *
 * @method     ChildEventoQuery joinWithFila($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fila relation
 *
 * @method     ChildEventoQuery leftJoinWithFila() Adds a LEFT JOIN clause and with to the query using the Fila relation
 * @method     ChildEventoQuery rightJoinWithFila() Adds a RIGHT JOIN clause and with to the query using the Fila relation
 * @method     ChildEventoQuery innerJoinWithFila() Adds a INNER JOIN clause and with to the query using the Fila relation
 *
 * @method     ChildEventoQuery leftJoinSenha($relationAlias = null) Adds a LEFT JOIN clause to the query using the Senha relation
 * @method     ChildEventoQuery rightJoinSenha($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Senha relation
 * @method     ChildEventoQuery innerJoinSenha($relationAlias = null) Adds a INNER JOIN clause to the query using the Senha relation
 *
 * @method     ChildEventoQuery joinWithSenha($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Senha relation
 *
 * @method     ChildEventoQuery leftJoinWithSenha() Adds a LEFT JOIN clause and with to the query using the Senha relation
 * @method     ChildEventoQuery rightJoinWithSenha() Adds a RIGHT JOIN clause and with to the query using the Senha relation
 * @method     ChildEventoQuery innerJoinWithSenha() Adds a INNER JOIN clause and with to the query using the Senha relation
 *
 * @method     \Baja\Model\EquipeQuery|\Baja\Model\ParticipanteQuery|\Baja\Model\ProvaQuery|\Baja\Model\ResultadoQuery|\Baja\Model\FilaQuery|\Baja\Model\SenhaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEvento findOne(ConnectionInterface $con = null) Return the first ChildEvento matching the query
 * @method     ChildEvento findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEvento matching the query, or a new ChildEvento object populated from the query conditions when no match is found
 *
 * @method     ChildEvento findOneByEventoId(string $evento_id) Return the first ChildEvento filtered by the evento_id column
 * @method     ChildEvento findOneByTitulo(string $titulo) Return the first ChildEvento filtered by the titulo column
 * @method     ChildEvento findOneByNome(string $nome) Return the first ChildEvento filtered by the nome column
 * @method     ChildEvento findOneByTipo(int $tipo) Return the first ChildEvento filtered by the tipo column
 * @method     ChildEvento findOneByAno(int $ano) Return the first ChildEvento filtered by the ano column
 * @method     ChildEvento findOneByMenu(string $menu) Return the first ChildEvento filtered by the menu column
 * @method     ChildEvento findOneByAtivo(boolean $ativo) Return the first ChildEvento filtered by the ativo column
 * @method     ChildEvento findOneByFinalizado(boolean $finalizado) Return the first ChildEvento filtered by the finalizado column
 * @method     ChildEvento findOneBySpoilers(boolean $spoilers) Return the first ChildEvento filtered by the spoilers column
 * @method     ChildEvento findOneByTemCertificado(boolean $tem_certificado) Return the first ChildEvento filtered by the tem_certificado column
 * @method     ChildEvento findOneByPresidente(string $presidente) Return the first ChildEvento filtered by the presidente column
 * @method     ChildEvento findOneByData(string $data) Return the first ChildEvento filtered by the data column
 * @method     ChildEvento findOneByMandatoPresidente(string $mandato_presidente) Return the first ChildEvento filtered by the mandato_presidente column
 * @method     ChildEvento findOneByLocal(string $local) Return the first ChildEvento filtered by the local column
 * @method     ChildEvento findOneByEmAndamento(boolean $em_andamento) Return the first ChildEvento filtered by the em_andamento column *

 * @method     ChildEvento requirePk($key, ConnectionInterface $con = null) Return the ChildEvento by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOne(ConnectionInterface $con = null) Return the first ChildEvento matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEvento requireOneByEventoId(string $evento_id) Return the first ChildEvento filtered by the evento_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOneByTitulo(string $titulo) Return the first ChildEvento filtered by the titulo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOneByNome(string $nome) Return the first ChildEvento filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOneByTipo(int $tipo) Return the first ChildEvento filtered by the tipo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOneByAno(int $ano) Return the first ChildEvento filtered by the ano column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOneByMenu(string $menu) Return the first ChildEvento filtered by the menu column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOneByAtivo(boolean $ativo) Return the first ChildEvento filtered by the ativo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOneByFinalizado(boolean $finalizado) Return the first ChildEvento filtered by the finalizado column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOneBySpoilers(boolean $spoilers) Return the first ChildEvento filtered by the spoilers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOneByTemCertificado(boolean $tem_certificado) Return the first ChildEvento filtered by the tem_certificado column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOneByPresidente(string $presidente) Return the first ChildEvento filtered by the presidente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOneByData(string $data) Return the first ChildEvento filtered by the data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOneByMandatoPresidente(string $mandato_presidente) Return the first ChildEvento filtered by the mandato_presidente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOneByLocal(string $local) Return the first ChildEvento filtered by the local column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvento requireOneByEmAndamento(boolean $em_andamento) Return the first ChildEvento filtered by the em_andamento column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEvento[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEvento objects based on current ModelCriteria
 * @method     ChildEvento[]|ObjectCollection findByEventoId(string $evento_id) Return ChildEvento objects filtered by the evento_id column
 * @method     ChildEvento[]|ObjectCollection findByTitulo(string $titulo) Return ChildEvento objects filtered by the titulo column
 * @method     ChildEvento[]|ObjectCollection findByNome(string $nome) Return ChildEvento objects filtered by the nome column
 * @method     ChildEvento[]|ObjectCollection findByTipo(int $tipo) Return ChildEvento objects filtered by the tipo column
 * @method     ChildEvento[]|ObjectCollection findByAno(int $ano) Return ChildEvento objects filtered by the ano column
 * @method     ChildEvento[]|ObjectCollection findByMenu(string $menu) Return ChildEvento objects filtered by the menu column
 * @method     ChildEvento[]|ObjectCollection findByAtivo(boolean $ativo) Return ChildEvento objects filtered by the ativo column
 * @method     ChildEvento[]|ObjectCollection findByFinalizado(boolean $finalizado) Return ChildEvento objects filtered by the finalizado column
 * @method     ChildEvento[]|ObjectCollection findBySpoilers(boolean $spoilers) Return ChildEvento objects filtered by the spoilers column
 * @method     ChildEvento[]|ObjectCollection findByTemCertificado(boolean $tem_certificado) Return ChildEvento objects filtered by the tem_certificado column
 * @method     ChildEvento[]|ObjectCollection findByPresidente(string $presidente) Return ChildEvento objects filtered by the presidente column
 * @method     ChildEvento[]|ObjectCollection findByData(string $data) Return ChildEvento objects filtered by the data column
 * @method     ChildEvento[]|ObjectCollection findByMandatoPresidente(string $mandato_presidente) Return ChildEvento objects filtered by the mandato_presidente column
 * @method     ChildEvento[]|ObjectCollection findByLocal(string $local) Return ChildEvento objects filtered by the local column
 * @method     ChildEvento[]|ObjectCollection findByEmAndamento(boolean $em_andamento) Return ChildEvento objects filtered by the em_andamento column
 * @method     ChildEvento[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EventoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Baja\Model\Base\EventoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'resultados', $modelName = '\\Baja\\Model\\Evento', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEventoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEventoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEventoQuery) {
            return $criteria;
        }
        $query = new ChildEventoQuery();
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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildEvento|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EventoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EventoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEvento A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT evento_id, titulo, nome, tipo, ano, menu, ativo, finalizado, spoilers, tem_certificado, presidente, data, mandato_presidente, local, em_andamento FROM evento WHERE evento_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildEvento $obj */
            $obj = new ChildEvento();
            $obj->hydrate($row);
            EventoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEvento|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
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
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EventoTableMap::COL_EVENTO_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EventoTableMap::COL_EVENTO_ID, $keys, Criteria::IN);
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
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByEventoId($eventoId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eventoId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventoTableMap::COL_EVENTO_ID, $eventoId, $comparison);
    }

    /**
     * Filter the query on the titulo column
     *
     * Example usage:
     * <code>
     * $query->filterByTitulo('fooValue');   // WHERE titulo = 'fooValue'
     * $query->filterByTitulo('%fooValue%', Criteria::LIKE); // WHERE titulo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $titulo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByTitulo($titulo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($titulo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventoTableMap::COL_TITULO, $titulo, $comparison);
    }

    /**
     * Filter the query on the nome column
     *
     * Example usage:
     * <code>
     * $query->filterByNome('fooValue');   // WHERE nome = 'fooValue'
     * $query->filterByNome('%fooValue%', Criteria::LIKE); // WHERE nome LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nome The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByNome($nome = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nome)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventoTableMap::COL_NOME, $nome, $comparison);
    }

    /**
     * Filter the query on the tipo column
     *
     * @param     mixed $tipo The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByTipo($tipo = null, $comparison = null)
    {
        $valueSet = EventoTableMap::getValueSet(EventoTableMap::COL_TIPO);
        if (is_scalar($tipo)) {
            if (!in_array($tipo, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $tipo));
            }
            $tipo = array_search($tipo, $valueSet);
        } elseif (is_array($tipo)) {
            $convertedValues = array();
            foreach ($tipo as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $tipo = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventoTableMap::COL_TIPO, $tipo, $comparison);
    }

    /**
     * Filter the query on the ano column
     *
     * Example usage:
     * <code>
     * $query->filterByAno(1234); // WHERE ano = 1234
     * $query->filterByAno(array(12, 34)); // WHERE ano IN (12, 34)
     * $query->filterByAno(array('min' => 12)); // WHERE ano > 12
     * </code>
     *
     * @param     mixed $ano The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByAno($ano = null, $comparison = null)
    {
        if (is_array($ano)) {
            $useMinMax = false;
            if (isset($ano['min'])) {
                $this->addUsingAlias(EventoTableMap::COL_ANO, $ano['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ano['max'])) {
                $this->addUsingAlias(EventoTableMap::COL_ANO, $ano['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventoTableMap::COL_ANO, $ano, $comparison);
    }

    /**
     * Filter the query on the menu column
     *
     * Example usage:
     * <code>
     * $query->filterByMenu('fooValue');   // WHERE menu = 'fooValue'
     * $query->filterByMenu('%fooValue%', Criteria::LIKE); // WHERE menu LIKE '%fooValue%'
     * </code>
     *
     * @param     string $menu The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByMenu($menu = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($menu)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventoTableMap::COL_MENU, $menu, $comparison);
    }

    /**
     * Filter the query on the ativo column
     *
     * Example usage:
     * <code>
     * $query->filterByAtivo(true); // WHERE ativo = true
     * $query->filterByAtivo('yes'); // WHERE ativo = true
     * </code>
     *
     * @param     boolean|string $ativo The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByAtivo($ativo = null, $comparison = null)
    {
        if (is_string($ativo)) {
            $ativo = in_array(strtolower($ativo), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EventoTableMap::COL_ATIVO, $ativo, $comparison);
    }

    /**
     * Filter the query on the finalizado column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalizado(true); // WHERE finalizado = true
     * $query->filterByFinalizado('yes'); // WHERE finalizado = true
     * </code>
     *
     * @param     boolean|string $finalizado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByFinalizado($finalizado = null, $comparison = null)
    {
        if (is_string($finalizado)) {
            $finalizado = in_array(strtolower($finalizado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EventoTableMap::COL_FINALIZADO, $finalizado, $comparison);
    }

    /**
     * Filter the query on the spoilers column
     *
     * Example usage:
     * <code>
     * $query->filterBySpoilers(true); // WHERE spoilers = true
     * $query->filterBySpoilers('yes'); // WHERE spoilers = true
     * </code>
     *
     * @param     boolean|string $spoilers The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterBySpoilers($spoilers = null, $comparison = null)
    {
        if (is_string($spoilers)) {
            $spoilers = in_array(strtolower($spoilers), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EventoTableMap::COL_SPOILERS, $spoilers, $comparison);
    }

    /**
     * Filter the query on the tem_certificado column
     *
     * Example usage:
     * <code>
     * $query->filterByTemCertificado(true); // WHERE tem_certificado = true
     * $query->filterByTemCertificado('yes'); // WHERE tem_certificado = true
     * </code>
     *
     * @param     boolean|string $temCertificado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByTemCertificado($temCertificado = null, $comparison = null)
    {
        if (is_string($temCertificado)) {
            $temCertificado = in_array(strtolower($temCertificado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EventoTableMap::COL_TEM_CERTIFICADO, $temCertificado, $comparison);
    }

    /**
     * Filter the query on the presidente column
     *
     * Example usage:
     * <code>
     * $query->filterByPresidente('fooValue');   // WHERE presidente = 'fooValue'
     * $query->filterByPresidente('%fooValue%', Criteria::LIKE); // WHERE presidente LIKE '%fooValue%'
     * </code>
     *
     * @param     string $presidente The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByPresidente($presidente = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($presidente)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventoTableMap::COL_PRESIDENTE, $presidente, $comparison);
    }

    /**
     * Filter the query on the data column
     *
     * Example usage:
     * <code>
     * $query->filterByData('fooValue');   // WHERE data = 'fooValue'
     * $query->filterByData('%fooValue%', Criteria::LIKE); // WHERE data LIKE '%fooValue%'
     * </code>
     *
     * @param     string $data The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByData($data = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($data)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventoTableMap::COL_DATA, $data, $comparison);
    }

    /**
     * Filter the query on the mandato_presidente column
     *
     * Example usage:
     * <code>
     * $query->filterByMandatoPresidente('fooValue');   // WHERE mandato_presidente = 'fooValue'
     * $query->filterByMandatoPresidente('%fooValue%', Criteria::LIKE); // WHERE mandato_presidente LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mandatoPresidente The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByMandatoPresidente($mandatoPresidente = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mandatoPresidente)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventoTableMap::COL_MANDATO_PRESIDENTE, $mandatoPresidente, $comparison);
    }

    /**
     * Filter the query on the local column
     *
     * Example usage:
     * <code>
     * $query->filterByLocal('fooValue');   // WHERE local = 'fooValue'
     * $query->filterByLocal('%fooValue%', Criteria::LIKE); // WHERE local LIKE '%fooValue%'
     * </code>
     *
     * @param     string $local The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByLocal($local = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($local)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventoTableMap::COL_LOCAL, $local, $comparison);
    }

    /**
     * Filter the query on the em_andamento column
     *
     * Example usage:
     * <code>
     * $query->filterByEmAndamento(true); // WHERE em_andamento = true
     * $query->filterByEmAndamento('yes'); // WHERE em_andamento = true
     * </code>
     *
     * @param     boolean|string $emAndamento The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function filterByEmAndamento($emAndamento = null, $comparison = null)
    {
        if (is_string($emAndamento)) {
            $emAndamento = in_array(strtolower($emAndamento), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EventoTableMap::COL_EM_ANDAMENTO, $emAndamento, $comparison);
    }

    /**
     * Filter the query by a related \Baja\Model\Equipe object
     *
     * @param \Baja\Model\Equipe|ObjectCollection $equipe the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEventoQuery The current query, for fluid interface
     */
    public function filterByEquipe($equipe, $comparison = null)
    {
        if ($equipe instanceof \Baja\Model\Equipe) {
            return $this
                ->addUsingAlias(EventoTableMap::COL_EVENTO_ID, $equipe->getEventoId(), $comparison);
        } elseif ($equipe instanceof ObjectCollection) {
            return $this
                ->useEquipeQuery()
                ->filterByPrimaryKeys($equipe->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEquipe() only accepts arguments of type \Baja\Model\Equipe or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Equipe relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function joinEquipe($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useEquipeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEquipe($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Equipe', '\Baja\Model\EquipeQuery');
    }

    /**
     * Filter the query by a related \Baja\Model\Participante object
     *
     * @param \Baja\Model\Participante|ObjectCollection $participante the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEventoQuery The current query, for fluid interface
     */
    public function filterByParticipante($participante, $comparison = null)
    {
        if ($participante instanceof \Baja\Model\Participante) {
            return $this
                ->addUsingAlias(EventoTableMap::COL_EVENTO_ID, $participante->getEventoId(), $comparison);
        } elseif ($participante instanceof ObjectCollection) {
            return $this
                ->useParticipanteQuery()
                ->filterByPrimaryKeys($participante->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByParticipante() only accepts arguments of type \Baja\Model\Participante or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Participante relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function joinParticipante($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Participante');

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
            $this->addJoinObject($join, 'Participante');
        }

        return $this;
    }

    /**
     * Use the Participante relation Participante object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Baja\Model\ParticipanteQuery A secondary query class using the current class as primary query
     */
    public function useParticipanteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinParticipante($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Participante', '\Baja\Model\ParticipanteQuery');
    }

    /**
     * Filter the query by a related \Baja\Model\Prova object
     *
     * @param \Baja\Model\Prova|ObjectCollection $prova the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEventoQuery The current query, for fluid interface
     */
    public function filterByProva($prova, $comparison = null)
    {
        if ($prova instanceof \Baja\Model\Prova) {
            return $this
                ->addUsingAlias(EventoTableMap::COL_EVENTO_ID, $prova->getEventoId(), $comparison);
        } elseif ($prova instanceof ObjectCollection) {
            return $this
                ->useProvaQuery()
                ->filterByPrimaryKeys($prova->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProva() only accepts arguments of type \Baja\Model\Prova or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Prova relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
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
     * Filter the query by a related \Baja\Model\Resultado object
     *
     * @param \Baja\Model\Resultado|ObjectCollection $resultado the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEventoQuery The current query, for fluid interface
     */
    public function filterByResultado($resultado, $comparison = null)
    {
        if ($resultado instanceof \Baja\Model\Resultado) {
            return $this
                ->addUsingAlias(EventoTableMap::COL_EVENTO_ID, $resultado->getEventoId(), $comparison);
        } elseif ($resultado instanceof ObjectCollection) {
            return $this
                ->useResultadoQuery()
                ->filterByPrimaryKeys($resultado->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByResultado() only accepts arguments of type \Baja\Model\Resultado or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Resultado relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function joinResultado($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Resultado');

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
            $this->addJoinObject($join, 'Resultado');
        }

        return $this;
    }

    /**
     * Use the Resultado relation Resultado object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Baja\Model\ResultadoQuery A secondary query class using the current class as primary query
     */
    public function useResultadoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinResultado($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Resultado', '\Baja\Model\ResultadoQuery');
    }

    /**
     * Filter the query by a related \Baja\Model\Fila object
     *
     * @param \Baja\Model\Fila|ObjectCollection $fila the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEventoQuery The current query, for fluid interface
     */
    public function filterByFila($fila, $comparison = null)
    {
        if ($fila instanceof \Baja\Model\Fila) {
            return $this
                ->addUsingAlias(EventoTableMap::COL_EVENTO_ID, $fila->getEventoId(), $comparison);
        } elseif ($fila instanceof ObjectCollection) {
            return $this
                ->useFilaQuery()
                ->filterByPrimaryKeys($fila->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFila() only accepts arguments of type \Baja\Model\Fila or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fila relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function joinFila($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fila');

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
            $this->addJoinObject($join, 'Fila');
        }

        return $this;
    }

    /**
     * Use the Fila relation Fila object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Baja\Model\FilaQuery A secondary query class using the current class as primary query
     */
    public function useFilaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFila($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fila', '\Baja\Model\FilaQuery');
    }

    /**
     * Filter the query by a related \Baja\Model\Senha object
     *
     * @param \Baja\Model\Senha|ObjectCollection $senha the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEventoQuery The current query, for fluid interface
     */
    public function filterBySenha($senha, $comparison = null)
    {
        if ($senha instanceof \Baja\Model\Senha) {
            return $this
                ->addUsingAlias(EventoTableMap::COL_EVENTO_ID, $senha->getEventoId(), $comparison);
        } elseif ($senha instanceof ObjectCollection) {
            return $this
                ->useSenhaQuery()
                ->filterByPrimaryKeys($senha->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySenha() only accepts arguments of type \Baja\Model\Senha or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Senha relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function joinSenha($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Senha');

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
            $this->addJoinObject($join, 'Senha');
        }

        return $this;
    }

    /**
     * Use the Senha relation Senha object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Baja\Model\SenhaQuery A secondary query class using the current class as primary query
     */
    public function useSenhaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSenha($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Senha', '\Baja\Model\SenhaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEvento $evento Object to remove from the list of results
     *
     * @return $this|ChildEventoQuery The current query, for fluid interface
     */
    public function prune($evento = null)
    {
        if ($evento) {
            $this->addUsingAlias(EventoTableMap::COL_EVENTO_ID, $evento->getEventoId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the evento table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EventoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EventoTableMap::clearInstancePool();
            EventoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EventoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EventoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EventoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EventoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EventoQuery
