<?php

namespace Drupal\itkdev_user_log\Helper;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\user\UserInterface;

/**
 * Helper for logging user deletion and creating view.
 */
class Helper {

  use StringTranslationTrait;

  /**
   * TimeInterface variable.
   *
   * @var \Drupal\Component\Datetime\TimeInterface
   */
  private $time;
  /**
   * AccountInterface variable.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  private $account;
  /**
   * Connection variable.
   *
   * @var \Drupal\Core\Database\Connection
   */
  private $database;

  /**
   * Helper constructor.
   */
  public function __construct(AccountInterface $accountInterface, Connection $connection, TimeInterface $timeInterface) {
    $this->account = $accountInterface;
    $this->database = $connection;
    $this->time = $timeInterface;

  }

  /**
   * Implements hook_ENTITY_TYPE_delete().
   */
  public function userDelete(EntityInterface $entity) {
    if ($entity instanceof UserInterface) {

      $this->database->insert('itkdev_user_log')
        ->fields([
          'deleted_user_id' => $entity->id(),
          'deleted_at' => $this->time->getCurrentTime(),
          'deleted_by' => $this->account->id(),
          'deleted_user_name' => $entity->getAccountName(),
          'deleted_user_mail' => $entity->getEmail(),
          'deleted_user' => serialize($entity),
        ])
        ->execute();
    }
  }

  /**
   * Implements hook_views_data().
   */
  public function viewsData() {
    $data = [];
    $data['itkdev_user_log'] = [];
    $data['itkdev_user_log']['table'] = [];
    $data['itkdev_user_log']['table']['group'] = $this->t('User Delete Log');
    $data['itkdev_user_log']['table']['provider'] = 'itkdev_user_log';
    $data['itkdev_user_log']['table']['base'] = [
      'field' => 'user_delete_log_id',
      'title' => $this->t('User Delete Log'),
      'help' => $this->t('The User Delete Log Table'),
    ];

    $data['itkdev_user_log']['user_delete_log_id'] = [
      'title' => $this->t('User Delete Log ID'),
      'help' => $this->t('The User Delete Log ID'),
      'field' => [
        // ID of field handler plugin to use.
        'id' => 'numeric',
      ],
      'sort' => [
        // ID of sort handler plugin to use.
        'id' => 'standard',
      ],
      'filter' => [
        // ID of filter handler plugin to use.
        'id' => 'numeric',
      ],
      'argument' => [
        // ID of argument handler plugin to use.
        'id' => 'numeric',
      ],
    ];

    $data['itkdev_user_log']['deleted_user_id'] = [
      'title' => $this->t('User ID'),
      'help' => $this->t('The deleted User ID'),
      'field' => [
        'id' => 'numeric',
      ],
      'sort' => [
        'id' => 'standard',
      ],
      'filter' => [
        'id' => 'numeric',
      ],
      'argument' => [
        'id' => 'numeric',
      ],
    ];

    $data['itkdev_user_log']['deleted_at'] = [
      'title' => $this->t('Deleted At'),
      'help' => $this->t('The user deletion date'),
      'field' => [
        'id' => 'date',
      ],
      'sort' => [
        'id' => 'date',
      ],
      'filter' => [
        'id' => 'date',
      ],
    ];

    $data['itkdev_user_log']['deleted_by'] = [
      'title' => $this->t('Deleted By'),
      'help' => $this->t('The user ID of the deleting account'),
      'field' => [
        'id' => 'numeric',
      ],
      'sort' => [
        'id' => 'standard',
      ],
      'filter' => [
        'id' => 'numeric',
      ],
      'argument' => [
        'id' => 'numeric',
      ],
    ];

    $data['itkdev_user_log']['deleted_user_name'] = [
      'title' => $this->t('Deleted User Name'),
      'help' => $this->t('Name of deleted user.'),
      'field' => [
        // ID of field handler plugin to use.
        'id' => 'standard',
      ],
      'sort' => [
        // ID of sort handler plugin to use.
        'id' => 'standard',
      ],
      'filter' => [
        // ID of filter handler plugin to use.
        'id' => 'string',
      ],
      'argument' => [
        // ID of argument handler plugin to use.
        'id' => 'string',
      ],
    ];

    $data['itkdev_user_log']['deleted_user_mail'] = [
      'title' => $this->t('Deleted User Mail'),
      'help' => $this->t('Mail of deleted user.'),
      'field' => [
        // ID of field handler plugin to use.
        'id' => 'standard',
      ],
      'sort' => [
        // ID of sort handler plugin to use.
        'id' => 'standard',
      ],
      'filter' => [
        // ID of filter handler plugin to use.
        'id' => 'string',
      ],
      'argument' => [
        // ID of argument handler plugin to use.
        'id' => 'string',
      ],
    ];

    $data['itkdev_user_log']['deleted_user'] = [
      'title' => $this->t('Deleted User'),
      'help' => $this->t('The serialized deleted user'),
      'field' => [
        'id' => 'text',
      ],
      'sort' => [
        'id' => 'standard',
      ],
      'filter' => [
        'id' => 'numeric',
      ],
      'argument' => [
        'id' => 'numeric',
      ],
    ];

    return $data;
  }

}
