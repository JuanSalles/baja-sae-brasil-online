<?php

namespace Baja\Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use Baja\Model\Evento as ChildEvento;
use Baja\Model\EventoQuery as ChildEventoQuery;
use Baja\Model\Input as ChildInput;
use Baja\Model\InputQuery as ChildInputQuery;
use Baja\Model\Prova as ChildProva;
use Baja\Model\ProvaQuery as ChildProvaQuery;
use Baja\Model\Tournament as ChildTournament;
use Baja\Model\TournamentQuery as ChildTournamentQuery;
use Baja\Model\Map\InputTableMap;
use Baja\Model\Map\ProvaTableMap;
use Baja\Model\Map\TournamentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'prova' table.
 *
 *
 *
 * @package    propel.generator.Baja.Model.Base
 */
abstract class Prova implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Baja\\Model\\Map\\ProvaTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the evento_id field.
     *
     * @var        string
     */
    protected $evento_id;

    /**
     * The value for the prova_id field.
     *
     * @var        string
     */
    protected $prova_id;

    /**
     * The value for the nome field.
     *
     * @var        string
     */
    protected $nome;

    /**
     * The value for the status field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $status;

    /**
     * The value for the tempo field.
     *
     * @var        int
     */
    protected $tempo;

    /**
     * The value for the modificado field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $modificado;

    /**
     * The value for the params field.
     *
     * @var        string
     */
    protected $params;

    /**
     * The value for the totals field.
     *
     * @var        string
     */
    protected $totals;

    /**
     * @var        ChildEvento
     */
    protected $aEvento;

    /**
     * @var        ObjectCollection|ChildInput[] Collection to store aggregation of ChildInput objects.
     */
    protected $collInputs;
    protected $collInputsPartial;

    /**
     * @var        ObjectCollection|ChildTournament[] Collection to store aggregation of ChildTournament objects.
     */
    protected $collTournaments;
    protected $collTournamentsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildInput[]
     */
    protected $inputsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTournament[]
     */
    protected $tournamentsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->status = 0;
    }

    /**
     * Initializes internal state of Baja\Model\Base\Prova object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Prova</code> instance.  If
     * <code>obj</code> is an instance of <code>Prova</code>, delegates to
     * <code>equals(Prova)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [evento_id] column value.
     *
     * @return string
     */
    public function getEventoId()
    {
        return $this->evento_id;
    }

    /**
     * Get the [prova_id] column value.
     *
     * @return string
     */
    public function getProvaId()
    {
        return $this->prova_id;
    }

    /**
     * Get the [nome] column value.
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Get the [status] column value.
     *
     * @return string
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStatus()
    {
        if (null === $this->status) {
            return null;
        }
        $valueSet = ProvaTableMap::getValueSet(ProvaTableMap::COL_STATUS);
        if (!isset($valueSet[$this->status])) {
            throw new PropelException('Unknown stored enum key: ' . $this->status);
        }

        return $valueSet[$this->status];
    }

    /**
     * Get the [tempo] column value.
     *
     * @return int
     */
    public function getTempo()
    {
        return $this->tempo;
    }

    /**
     * Get the [optionally formatted] temporal [modificado] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getModificado($format = NULL)
    {
        if ($format === null) {
            return $this->modificado;
        } else {
            return $this->modificado instanceof \DateTimeInterface ? $this->modificado->format($format) : null;
        }
    }

    /**
     * Get the [params] column value.
     *
     * @return string
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Get the [totals] column value.
     *
     * @return string
     */
    public function getTotals()
    {
        return $this->totals;
    }

    /**
     * Set the value of [evento_id] column.
     *
     * @param string $v New value
     * @return $this|\Baja\Model\Prova The current object (for fluent API support)
     */
    public function setEventoId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->evento_id !== $v) {
            $this->evento_id = $v;
            $this->modifiedColumns[ProvaTableMap::COL_EVENTO_ID] = true;
        }

        if ($this->aEvento !== null && $this->aEvento->getEventoId() !== $v) {
            $this->aEvento = null;
        }

        return $this;
    } // setEventoId()

    /**
     * Set the value of [prova_id] column.
     *
     * @param string $v New value
     * @return $this|\Baja\Model\Prova The current object (for fluent API support)
     */
    public function setProvaId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->prova_id !== $v) {
            $this->prova_id = $v;
            $this->modifiedColumns[ProvaTableMap::COL_PROVA_ID] = true;
        }

        return $this;
    } // setProvaId()

    /**
     * Set the value of [nome] column.
     *
     * @param string $v New value
     * @return $this|\Baja\Model\Prova The current object (for fluent API support)
     */
    public function setNome($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nome !== $v) {
            $this->nome = $v;
            $this->modifiedColumns[ProvaTableMap::COL_NOME] = true;
        }

        return $this;
    } // setNome()

    /**
     * Set the value of [status] column.
     *
     * @param  string $v new value
     * @return $this|\Baja\Model\Prova The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $valueSet = ProvaTableMap::getValueSet(ProvaTableMap::COL_STATUS);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[ProvaTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [tempo] column.
     *
     * @param int|null $v New value
     * @return $this|\Baja\Model\Prova The current object (for fluent API support)
     */
    public function setTempo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->tempo !== $v) {
            $this->tempo = $v;
            $this->modifiedColumns[ProvaTableMap::COL_TEMPO] = true;
        }

        return $this;
    } // setTempo()

    /**
     * Sets the value of [modificado] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Baja\Model\Prova The current object (for fluent API support)
     */
    public function setModificado($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modificado !== null || $dt !== null) {
            if ($this->modificado === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->modificado->format("Y-m-d H:i:s.u")) {
                $this->modificado = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProvaTableMap::COL_MODIFICADO] = true;
            }
        } // if either are not null

        return $this;
    } // setModificado()

    /**
     * Set the value of [params] column.
     *
     * @param string|null $v New value
     * @return $this|\Baja\Model\Prova The current object (for fluent API support)
     */
    public function setParams($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->params !== $v) {
            $this->params = $v;
            $this->modifiedColumns[ProvaTableMap::COL_PARAMS] = true;
        }

        return $this;
    } // setParams()

    /**
     * Set the value of [totals] column.
     *
     * @param string|null $v New value
     * @return $this|\Baja\Model\Prova The current object (for fluent API support)
     */
    public function setTotals($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->totals !== $v) {
            $this->totals = $v;
            $this->modifiedColumns[ProvaTableMap::COL_TOTALS] = true;
        }

        return $this;
    } // setTotals()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->status !== 0) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProvaTableMap::translateFieldName('EventoId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->evento_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProvaTableMap::translateFieldName('ProvaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prova_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProvaTableMap::translateFieldName('Nome', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nome = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProvaTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProvaTableMap::translateFieldName('Tempo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tempo = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ProvaTableMap::translateFieldName('Modificado', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modificado = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ProvaTableMap::translateFieldName('Params', TableMap::TYPE_PHPNAME, $indexType)];
            $this->params = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ProvaTableMap::translateFieldName('Totals', TableMap::TYPE_PHPNAME, $indexType)];
            $this->totals = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = ProvaTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Baja\\Model\\Prova'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aEvento !== null && $this->evento_id !== $this->aEvento->getEventoId()) {
            $this->aEvento = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProvaTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProvaQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEvento = null;
            $this->collInputs = null;

            $this->collTournaments = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Prova::setDeleted()
     * @see Prova::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProvaTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProvaQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProvaTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ProvaTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aEvento !== null) {
                if ($this->aEvento->isModified() || $this->aEvento->isNew()) {
                    $affectedRows += $this->aEvento->save($con);
                }
                $this->setEvento($this->aEvento);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->inputsScheduledForDeletion !== null) {
                if (!$this->inputsScheduledForDeletion->isEmpty()) {
                    \Baja\Model\InputQuery::create()
                        ->filterByPrimaryKeys($this->inputsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->inputsScheduledForDeletion = null;
                }
            }

            if ($this->collInputs !== null) {
                foreach ($this->collInputs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tournamentsScheduledForDeletion !== null) {
                if (!$this->tournamentsScheduledForDeletion->isEmpty()) {
                    \Baja\Model\TournamentQuery::create()
                        ->filterByPrimaryKeys($this->tournamentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tournamentsScheduledForDeletion = null;
                }
            }

            if ($this->collTournaments !== null) {
                foreach ($this->collTournaments as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProvaTableMap::COL_EVENTO_ID)) {
            $modifiedColumns[':p' . $index++]  = 'evento_id';
        }
        if ($this->isColumnModified(ProvaTableMap::COL_PROVA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'prova_id';
        }
        if ($this->isColumnModified(ProvaTableMap::COL_NOME)) {
            $modifiedColumns[':p' . $index++]  = 'nome';
        }
        if ($this->isColumnModified(ProvaTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(ProvaTableMap::COL_TEMPO)) {
            $modifiedColumns[':p' . $index++]  = 'tempo';
        }
        if ($this->isColumnModified(ProvaTableMap::COL_MODIFICADO)) {
            $modifiedColumns[':p' . $index++]  = 'modificado';
        }
        if ($this->isColumnModified(ProvaTableMap::COL_PARAMS)) {
            $modifiedColumns[':p' . $index++]  = 'params';
        }
        if ($this->isColumnModified(ProvaTableMap::COL_TOTALS)) {
            $modifiedColumns[':p' . $index++]  = 'totals';
        }

        $sql = sprintf(
            'INSERT INTO prova (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'evento_id':
                        $stmt->bindValue($identifier, $this->evento_id, PDO::PARAM_STR);
                        break;
                    case 'prova_id':
                        $stmt->bindValue($identifier, $this->prova_id, PDO::PARAM_STR);
                        break;
                    case 'nome':
                        $stmt->bindValue($identifier, $this->nome, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case 'tempo':
                        $stmt->bindValue($identifier, $this->tempo, PDO::PARAM_INT);
                        break;
                    case 'modificado':
                        $stmt->bindValue($identifier, $this->modificado ? $this->modificado->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'params':
                        $stmt->bindValue($identifier, $this->params, PDO::PARAM_STR);
                        break;
                    case 'totals':
                        $stmt->bindValue($identifier, $this->totals, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProvaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getEventoId();
                break;
            case 1:
                return $this->getProvaId();
                break;
            case 2:
                return $this->getNome();
                break;
            case 3:
                return $this->getStatus();
                break;
            case 4:
                return $this->getTempo();
                break;
            case 5:
                return $this->getModificado();
                break;
            case 6:
                return $this->getParams();
                break;
            case 7:
                return $this->getTotals();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Prova'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Prova'][$this->hashCode()] = true;
        $keys = ProvaTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getEventoId(),
            $keys[1] => $this->getProvaId(),
            $keys[2] => $this->getNome(),
            $keys[3] => $this->getStatus(),
            $keys[4] => $this->getTempo(),
            $keys[5] => $this->getModificado(),
            $keys[6] => $this->getParams(),
            $keys[7] => $this->getTotals(),
        );
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aEvento) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'evento';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'evento';
                        break;
                    default:
                        $key = 'Evento';
                }

                $result[$key] = $this->aEvento->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collInputs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'inputs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'inputs';
                        break;
                    default:
                        $key = 'Inputs';
                }

                $result[$key] = $this->collInputs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTournaments) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'tournaments';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tournaments';
                        break;
                    default:
                        $key = 'Tournaments';
                }

                $result[$key] = $this->collTournaments->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Baja\Model\Prova
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProvaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Baja\Model\Prova
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setEventoId($value);
                break;
            case 1:
                $this->setProvaId($value);
                break;
            case 2:
                $this->setNome($value);
                break;
            case 3:
                $valueSet = ProvaTableMap::getValueSet(ProvaTableMap::COL_STATUS);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setStatus($value);
                break;
            case 4:
                $this->setTempo($value);
                break;
            case 5:
                $this->setModificado($value);
                break;
            case 6:
                $this->setParams($value);
                break;
            case 7:
                $this->setTotals($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ProvaTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setEventoId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setProvaId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setNome($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setStatus($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTempo($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setModificado($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setParams($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setTotals($arr[$keys[7]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Baja\Model\Prova The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ProvaTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProvaTableMap::COL_EVENTO_ID)) {
            $criteria->add(ProvaTableMap::COL_EVENTO_ID, $this->evento_id);
        }
        if ($this->isColumnModified(ProvaTableMap::COL_PROVA_ID)) {
            $criteria->add(ProvaTableMap::COL_PROVA_ID, $this->prova_id);
        }
        if ($this->isColumnModified(ProvaTableMap::COL_NOME)) {
            $criteria->add(ProvaTableMap::COL_NOME, $this->nome);
        }
        if ($this->isColumnModified(ProvaTableMap::COL_STATUS)) {
            $criteria->add(ProvaTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(ProvaTableMap::COL_TEMPO)) {
            $criteria->add(ProvaTableMap::COL_TEMPO, $this->tempo);
        }
        if ($this->isColumnModified(ProvaTableMap::COL_MODIFICADO)) {
            $criteria->add(ProvaTableMap::COL_MODIFICADO, $this->modificado);
        }
        if ($this->isColumnModified(ProvaTableMap::COL_PARAMS)) {
            $criteria->add(ProvaTableMap::COL_PARAMS, $this->params);
        }
        if ($this->isColumnModified(ProvaTableMap::COL_TOTALS)) {
            $criteria->add(ProvaTableMap::COL_TOTALS, $this->totals);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildProvaQuery::create();
        $criteria->add(ProvaTableMap::COL_EVENTO_ID, $this->evento_id);
        $criteria->add(ProvaTableMap::COL_PROVA_ID, $this->prova_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getEventoId() &&
            null !== $this->getProvaId();

        $validPrimaryKeyFKs = 1;
        $primaryKeyFKs = [];

        //relation prova_evento_id to table evento
        if ($this->aEvento && $hash = spl_object_hash($this->aEvento)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getEventoId();
        $pks[1] = $this->getProvaId();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param      array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setEventoId($keys[0]);
        $this->setProvaId($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return (null === $this->getEventoId()) && (null === $this->getProvaId());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Baja\Model\Prova (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEventoId($this->getEventoId());
        $copyObj->setProvaId($this->getProvaId());
        $copyObj->setNome($this->getNome());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setTempo($this->getTempo());
        $copyObj->setModificado($this->getModificado());
        $copyObj->setParams($this->getParams());
        $copyObj->setTotals($this->getTotals());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getInputs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addInput($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTournaments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTournament($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Baja\Model\Prova Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildEvento object.
     *
     * @param  ChildEvento $v
     * @return $this|\Baja\Model\Prova The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEvento(ChildEvento $v = null)
    {
        if ($v === null) {
            $this->setEventoId(NULL);
        } else {
            $this->setEventoId($v->getEventoId());
        }

        $this->aEvento = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEvento object, it will not be re-added.
        if ($v !== null) {
            $v->addProva($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEvento object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildEvento The associated ChildEvento object.
     * @throws PropelException
     */
    public function getEvento(ConnectionInterface $con = null)
    {
        if ($this->aEvento === null && (($this->evento_id !== "" && $this->evento_id !== null))) {
            $this->aEvento = ChildEventoQuery::create()->findPk($this->evento_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEvento->addProvas($this);
             */
        }

        return $this->aEvento;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Input' === $relationName) {
            $this->initInputs();
            return;
        }
        if ('Tournament' === $relationName) {
            $this->initTournaments();
            return;
        }
    }

    /**
     * Clears out the collInputs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addInputs()
     */
    public function clearInputs()
    {
        $this->collInputs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collInputs collection loaded partially.
     */
    public function resetPartialInputs($v = true)
    {
        $this->collInputsPartial = $v;
    }

    /**
     * Initializes the collInputs collection.
     *
     * By default this just sets the collInputs collection to an empty array (like clearcollInputs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initInputs($overrideExisting = true)
    {
        if (null !== $this->collInputs && !$overrideExisting) {
            return;
        }

        $collectionClassName = InputTableMap::getTableMap()->getCollectionClassName();

        $this->collInputs = new $collectionClassName;
        $this->collInputs->setModel('\Baja\Model\Input');
    }

    /**
     * Gets an array of ChildInput objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProva is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildInput[] List of ChildInput objects
     * @throws PropelException
     */
    public function getInputs(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collInputsPartial && !$this->isNew();
        if (null === $this->collInputs || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collInputs) {
                    $this->initInputs();
                } else {
                    $collectionClassName = InputTableMap::getTableMap()->getCollectionClassName();

                    $collInputs = new $collectionClassName;
                    $collInputs->setModel('\Baja\Model\Input');

                    return $collInputs;
                }
            } else {
                $collInputs = ChildInputQuery::create(null, $criteria)
                    ->filterByProva($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collInputsPartial && count($collInputs)) {
                        $this->initInputs(false);

                        foreach ($collInputs as $obj) {
                            if (false == $this->collInputs->contains($obj)) {
                                $this->collInputs->append($obj);
                            }
                        }

                        $this->collInputsPartial = true;
                    }

                    return $collInputs;
                }

                if ($partial && $this->collInputs) {
                    foreach ($this->collInputs as $obj) {
                        if ($obj->isNew()) {
                            $collInputs[] = $obj;
                        }
                    }
                }

                $this->collInputs = $collInputs;
                $this->collInputsPartial = false;
            }
        }

        return $this->collInputs;
    }

    /**
     * Sets a collection of ChildInput objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $inputs A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProva The current object (for fluent API support)
     */
    public function setInputs(Collection $inputs, ConnectionInterface $con = null)
    {
        /** @var ChildInput[] $inputsToDelete */
        $inputsToDelete = $this->getInputs(new Criteria(), $con)->diff($inputs);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->inputsScheduledForDeletion = clone $inputsToDelete;

        foreach ($inputsToDelete as $inputRemoved) {
            $inputRemoved->setProva(null);
        }

        $this->collInputs = null;
        foreach ($inputs as $input) {
            $this->addInput($input);
        }

        $this->collInputs = $inputs;
        $this->collInputsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Input objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Input objects.
     * @throws PropelException
     */
    public function countInputs(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collInputsPartial && !$this->isNew();
        if (null === $this->collInputs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collInputs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getInputs());
            }

            $query = ChildInputQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProva($this)
                ->count($con);
        }

        return count($this->collInputs);
    }

    /**
     * Method called to associate a ChildInput object to this object
     * through the ChildInput foreign key attribute.
     *
     * @param  ChildInput $l ChildInput
     * @return $this|\Baja\Model\Prova The current object (for fluent API support)
     */
    public function addInput(ChildInput $l)
    {
        if ($this->collInputs === null) {
            $this->initInputs();
            $this->collInputsPartial = true;
        }

        if (!$this->collInputs->contains($l)) {
            $this->doAddInput($l);

            if ($this->inputsScheduledForDeletion and $this->inputsScheduledForDeletion->contains($l)) {
                $this->inputsScheduledForDeletion->remove($this->inputsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildInput $input The ChildInput object to add.
     */
    protected function doAddInput(ChildInput $input)
    {
        $this->collInputs[]= $input;
        $input->setProva($this);
    }

    /**
     * @param  ChildInput $input The ChildInput object to remove.
     * @return $this|ChildProva The current object (for fluent API support)
     */
    public function removeInput(ChildInput $input)
    {
        if ($this->getInputs()->contains($input)) {
            $pos = $this->collInputs->search($input);
            $this->collInputs->remove($pos);
            if (null === $this->inputsScheduledForDeletion) {
                $this->inputsScheduledForDeletion = clone $this->collInputs;
                $this->inputsScheduledForDeletion->clear();
            }
            $this->inputsScheduledForDeletion[]= clone $input;
            $input->setProva(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Prova is new, it will return
     * an empty collection; or if this Prova has previously
     * been saved, it will retrieve related Inputs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Prova.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildInput[] List of ChildInput objects
     */
    public function getInputsJoinEquipe(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildInputQuery::create(null, $criteria);
        $query->joinWith('Equipe', $joinBehavior);

        return $this->getInputs($query, $con);
    }

    /**
     * Clears out the collTournaments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTournaments()
     */
    public function clearTournaments()
    {
        $this->collTournaments = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTournaments collection loaded partially.
     */
    public function resetPartialTournaments($v = true)
    {
        $this->collTournamentsPartial = $v;
    }

    /**
     * Initializes the collTournaments collection.
     *
     * By default this just sets the collTournaments collection to an empty array (like clearcollTournaments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTournaments($overrideExisting = true)
    {
        if (null !== $this->collTournaments && !$overrideExisting) {
            return;
        }

        $collectionClassName = TournamentTableMap::getTableMap()->getCollectionClassName();

        $this->collTournaments = new $collectionClassName;
        $this->collTournaments->setModel('\Baja\Model\Tournament');
    }

    /**
     * Gets an array of ChildTournament objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProva is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTournament[] List of ChildTournament objects
     * @throws PropelException
     */
    public function getTournaments(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTournamentsPartial && !$this->isNew();
        if (null === $this->collTournaments || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTournaments) {
                    $this->initTournaments();
                } else {
                    $collectionClassName = TournamentTableMap::getTableMap()->getCollectionClassName();

                    $collTournaments = new $collectionClassName;
                    $collTournaments->setModel('\Baja\Model\Tournament');

                    return $collTournaments;
                }
            } else {
                $collTournaments = ChildTournamentQuery::create(null, $criteria)
                    ->filterByProva($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTournamentsPartial && count($collTournaments)) {
                        $this->initTournaments(false);

                        foreach ($collTournaments as $obj) {
                            if (false == $this->collTournaments->contains($obj)) {
                                $this->collTournaments->append($obj);
                            }
                        }

                        $this->collTournamentsPartial = true;
                    }

                    return $collTournaments;
                }

                if ($partial && $this->collTournaments) {
                    foreach ($this->collTournaments as $obj) {
                        if ($obj->isNew()) {
                            $collTournaments[] = $obj;
                        }
                    }
                }

                $this->collTournaments = $collTournaments;
                $this->collTournamentsPartial = false;
            }
        }

        return $this->collTournaments;
    }

    /**
     * Sets a collection of ChildTournament objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $tournaments A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProva The current object (for fluent API support)
     */
    public function setTournaments(Collection $tournaments, ConnectionInterface $con = null)
    {
        /** @var ChildTournament[] $tournamentsToDelete */
        $tournamentsToDelete = $this->getTournaments(new Criteria(), $con)->diff($tournaments);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->tournamentsScheduledForDeletion = clone $tournamentsToDelete;

        foreach ($tournamentsToDelete as $tournamentRemoved) {
            $tournamentRemoved->setProva(null);
        }

        $this->collTournaments = null;
        foreach ($tournaments as $tournament) {
            $this->addTournament($tournament);
        }

        $this->collTournaments = $tournaments;
        $this->collTournamentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Tournament objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Tournament objects.
     * @throws PropelException
     */
    public function countTournaments(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTournamentsPartial && !$this->isNew();
        if (null === $this->collTournaments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTournaments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTournaments());
            }

            $query = ChildTournamentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProva($this)
                ->count($con);
        }

        return count($this->collTournaments);
    }

    /**
     * Method called to associate a ChildTournament object to this object
     * through the ChildTournament foreign key attribute.
     *
     * @param  ChildTournament $l ChildTournament
     * @return $this|\Baja\Model\Prova The current object (for fluent API support)
     */
    public function addTournament(ChildTournament $l)
    {
        if ($this->collTournaments === null) {
            $this->initTournaments();
            $this->collTournamentsPartial = true;
        }

        if (!$this->collTournaments->contains($l)) {
            $this->doAddTournament($l);

            if ($this->tournamentsScheduledForDeletion and $this->tournamentsScheduledForDeletion->contains($l)) {
                $this->tournamentsScheduledForDeletion->remove($this->tournamentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTournament $tournament The ChildTournament object to add.
     */
    protected function doAddTournament(ChildTournament $tournament)
    {
        $this->collTournaments[]= $tournament;
        $tournament->setProva($this);
    }

    /**
     * @param  ChildTournament $tournament The ChildTournament object to remove.
     * @return $this|ChildProva The current object (for fluent API support)
     */
    public function removeTournament(ChildTournament $tournament)
    {
        if ($this->getTournaments()->contains($tournament)) {
            $pos = $this->collTournaments->search($tournament);
            $this->collTournaments->remove($pos);
            if (null === $this->tournamentsScheduledForDeletion) {
                $this->tournamentsScheduledForDeletion = clone $this->collTournaments;
                $this->tournamentsScheduledForDeletion->clear();
            }
            $this->tournamentsScheduledForDeletion[]= clone $tournament;
            $tournament->setProva(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Prova is new, it will return
     * an empty collection; or if this Prova has previously
     * been saved, it will retrieve related Tournaments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Prova.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTournament[] List of ChildTournament objects
     */
    public function getTournamentsJoinEquipe(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTournamentQuery::create(null, $criteria);
        $query->joinWith('Equipe', $joinBehavior);

        return $this->getTournaments($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aEvento) {
            $this->aEvento->removeProva($this);
        }
        $this->evento_id = null;
        $this->prova_id = null;
        $this->nome = null;
        $this->status = null;
        $this->tempo = null;
        $this->modificado = null;
        $this->params = null;
        $this->totals = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collInputs) {
                foreach ($this->collInputs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTournaments) {
                foreach ($this->collTournaments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collInputs = null;
        $this->collTournaments = null;
        $this->aEvento = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProvaTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
