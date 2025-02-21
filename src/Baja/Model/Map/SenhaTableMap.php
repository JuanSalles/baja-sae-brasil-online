<?php

namespace Baja\Model\Map;

use Baja\Model\Senha;
use Baja\Model\SenhaQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'senha' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SenhaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Baja.Model.Map.SenhaTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'resultados';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'senha';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Baja\\Model\\Senha';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Baja.Model.Senha';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the evento_id field
     */
    const COL_EVENTO_ID = 'senha.evento_id';

    /**
     * the column name for the fila_id field
     */
    const COL_FILA_ID = 'senha.fila_id';

    /**
     * the column name for the senha field
     */
    const COL_SENHA = 'senha.senha';

    /**
     * the column name for the equipe_id field
     */
    const COL_EQUIPE_ID = 'senha.equipe_id';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'senha.status';

    /**
     * the column name for the ts_requisicao field
     */
    const COL_TS_REQUISICAO = 'senha.ts_requisicao';

    /**
     * the column name for the ts_status field
     */
    const COL_TS_STATUS = 'senha.ts_status';

    /**
     * the column name for the detalhes field
     */
    const COL_DETALHES = 'senha.detalhes';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('EventoId', 'FilaId', 'Senha', 'EquipeId', 'Status', 'TsRequisicao', 'TsStatus', 'Detalhes', ),
        self::TYPE_CAMELNAME     => array('eventoId', 'filaId', 'senha', 'equipeId', 'status', 'tsRequisicao', 'tsStatus', 'detalhes', ),
        self::TYPE_COLNAME       => array(SenhaTableMap::COL_EVENTO_ID, SenhaTableMap::COL_FILA_ID, SenhaTableMap::COL_SENHA, SenhaTableMap::COL_EQUIPE_ID, SenhaTableMap::COL_STATUS, SenhaTableMap::COL_TS_REQUISICAO, SenhaTableMap::COL_TS_STATUS, SenhaTableMap::COL_DETALHES, ),
        self::TYPE_FIELDNAME     => array('evento_id', 'fila_id', 'senha', 'equipe_id', 'status', 'ts_requisicao', 'ts_status', 'detalhes', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('EventoId' => 0, 'FilaId' => 1, 'Senha' => 2, 'EquipeId' => 3, 'Status' => 4, 'TsRequisicao' => 5, 'TsStatus' => 6, 'Detalhes' => 7, ),
        self::TYPE_CAMELNAME     => array('eventoId' => 0, 'filaId' => 1, 'senha' => 2, 'equipeId' => 3, 'status' => 4, 'tsRequisicao' => 5, 'tsStatus' => 6, 'detalhes' => 7, ),
        self::TYPE_COLNAME       => array(SenhaTableMap::COL_EVENTO_ID => 0, SenhaTableMap::COL_FILA_ID => 1, SenhaTableMap::COL_SENHA => 2, SenhaTableMap::COL_EQUIPE_ID => 3, SenhaTableMap::COL_STATUS => 4, SenhaTableMap::COL_TS_REQUISICAO => 5, SenhaTableMap::COL_TS_STATUS => 6, SenhaTableMap::COL_DETALHES => 7, ),
        self::TYPE_FIELDNAME     => array('evento_id' => 0, 'fila_id' => 1, 'senha' => 2, 'equipe_id' => 3, 'status' => 4, 'ts_requisicao' => 5, 'ts_status' => 6, 'detalhes' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('senha');
        $this->setPhpName('Senha');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Baja\\Model\\Senha');
        $this->setPackage('Baja.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addForeignPrimaryKey('evento_id', 'EventoId', 'CHAR' , 'evento', 'evento_id', true, 16, null);
        $this->addForeignPrimaryKey('evento_id', 'EventoId', 'CHAR' , 'equipe', 'evento_id', true, 16, null);
        $this->addPrimaryKey('fila_id', 'FilaId', 'INTEGER', true, 4, null);
        $this->addPrimaryKey('senha', 'Senha', 'INTEGER', true, 11, null);
        $this->addForeignPrimaryKey('equipe_id', 'EquipeId', 'INTEGER' , 'equipe', 'equipe_id', true, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', true, 1, 0);
        $this->addColumn('ts_requisicao', 'TsRequisicao', 'BIGINT', false, null, null);
        $this->addColumn('ts_status', 'TsStatus', 'BIGINT', false, null, null);
        $this->addColumn('detalhes', 'Detalhes', 'LONGVARCHAR', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Evento', '\\Baja\\Model\\Evento', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':evento_id',
    1 => ':evento_id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('Equipe', '\\Baja\\Model\\Equipe', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':equipe_id',
    1 => ':equipe_id',
  ),
  1 =>
  array (
    0 => ':evento_id',
    1 => ':evento_id',
  ),
), 'CASCADE', 'CASCADE', null, false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Baja\Model\Senha $obj A \Baja\Model\Senha object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getEventoId() || is_scalar($obj->getEventoId()) || is_callable([$obj->getEventoId(), '__toString']) ? (string) $obj->getEventoId() : $obj->getEventoId()), (null === $obj->getFilaId() || is_scalar($obj->getFilaId()) || is_callable([$obj->getFilaId(), '__toString']) ? (string) $obj->getFilaId() : $obj->getFilaId()), (null === $obj->getSenha() || is_scalar($obj->getSenha()) || is_callable([$obj->getSenha(), '__toString']) ? (string) $obj->getSenha() : $obj->getSenha()), (null === $obj->getEquipeId() || is_scalar($obj->getEquipeId()) || is_callable([$obj->getEquipeId(), '__toString']) ? (string) $obj->getEquipeId() : $obj->getEquipeId())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Baja\Model\Senha object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Baja\Model\Senha) {
                $key = serialize([(null === $value->getEventoId() || is_scalar($value->getEventoId()) || is_callable([$value->getEventoId(), '__toString']) ? (string) $value->getEventoId() : $value->getEventoId()), (null === $value->getFilaId() || is_scalar($value->getFilaId()) || is_callable([$value->getFilaId(), '__toString']) ? (string) $value->getFilaId() : $value->getFilaId()), (null === $value->getSenha() || is_scalar($value->getSenha()) || is_callable([$value->getSenha(), '__toString']) ? (string) $value->getSenha() : $value->getSenha()), (null === $value->getEquipeId() || is_scalar($value->getEquipeId()) || is_callable([$value->getEquipeId(), '__toString']) ? (string) $value->getEquipeId() : $value->getEquipeId())]);

            } elseif (is_array($value) && count($value) === 4) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1]), (null === $value[2] || is_scalar($value[2]) || is_callable([$value[2], '__toString']) ? (string) $value[2] : $value[2]), (null === $value[3] || is_scalar($value[3]) || is_callable([$value[3], '__toString']) ? (string) $value[3] : $value[3])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Baja\Model\Senha object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FilaId', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Senha', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('EquipeId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FilaId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FilaId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FilaId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FilaId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FilaId', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Senha', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Senha', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Senha', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Senha', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Senha', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('EquipeId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('EquipeId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('EquipeId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('EquipeId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 3 + $offset : static::translateFieldName('EquipeId', TableMap::TYPE_PHPNAME, $indexType)])]);
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
            $pks = [];

        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('FilaId', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 2 + $offset
                : self::translateFieldName('Senha', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 3 + $offset
                : self::translateFieldName('EquipeId', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? SenhaTableMap::CLASS_DEFAULT : SenhaTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Senha object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SenhaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SenhaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SenhaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SenhaTableMap::OM_CLASS;
            /** @var Senha $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SenhaTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SenhaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SenhaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Senha $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SenhaTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SenhaTableMap::COL_EVENTO_ID);
            $criteria->addSelectColumn(SenhaTableMap::COL_FILA_ID);
            $criteria->addSelectColumn(SenhaTableMap::COL_SENHA);
            $criteria->addSelectColumn(SenhaTableMap::COL_EQUIPE_ID);
            $criteria->addSelectColumn(SenhaTableMap::COL_STATUS);
            $criteria->addSelectColumn(SenhaTableMap::COL_TS_REQUISICAO);
            $criteria->addSelectColumn(SenhaTableMap::COL_TS_STATUS);
            $criteria->addSelectColumn(SenhaTableMap::COL_DETALHES);
        } else {
            $criteria->addSelectColumn($alias . '.evento_id');
            $criteria->addSelectColumn($alias . '.fila_id');
            $criteria->addSelectColumn($alias . '.senha');
            $criteria->addSelectColumn($alias . '.equipe_id');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.ts_requisicao');
            $criteria->addSelectColumn($alias . '.ts_status');
            $criteria->addSelectColumn($alias . '.detalhes');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(SenhaTableMap::DATABASE_NAME)->getTable(SenhaTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SenhaTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SenhaTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SenhaTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Senha or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Senha object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SenhaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Baja\Model\Senha) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SenhaTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(SenhaTableMap::COL_EVENTO_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(SenhaTableMap::COL_FILA_ID, $value[1]));
                $criterion->addAnd($criteria->getNewCriterion(SenhaTableMap::COL_SENHA, $value[2]));
                $criterion->addAnd($criteria->getNewCriterion(SenhaTableMap::COL_EQUIPE_ID, $value[3]));
                $criteria->addOr($criterion);
            }
        }

        $query = SenhaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SenhaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SenhaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the senha table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SenhaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Senha or Criteria object.
     *
     * @param mixed               $criteria Criteria or Senha object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SenhaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Senha object
        }

        if ($criteria->containsKey(SenhaTableMap::COL_SENHA) && $criteria->keyContainsValue(SenhaTableMap::COL_SENHA) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SenhaTableMap::COL_SENHA.')');
        }


        // Set the correct dbName
        $query = SenhaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SenhaTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SenhaTableMap::buildTableMap();
