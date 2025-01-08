DROP TABLE IF EXISTS /*TABLE_PREFIX*/t_sms_log;
CREATE TABLE /*TABLE_PREFIX*/t_sms_log (
  pk_i_id INT NOT NULL AUTO_INCREMENT,
  fk_i_user_id INT NULL,
  s_phone_number VARCHAR(50),
  s_message VARCHAR(500),
  s_action VARCHAR(50) NULL,
  s_provider VARCHAR(20) NULL,
  s_response VARCHAR(5000) NULL,
  s_error VARCHAR(1000) NULL,
  s_status VARCHAR(20) NULL,
  dt_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (pk_i_id)
) ENGINE=InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI';


DROP TABLE IF EXISTS /*TABLE_PREFIX*/t_sms_verification;
CREATE TABLE /*TABLE_PREFIX*/t_sms_verification (
  s_phone_number VARCHAR(50),
  s_email VARCHAR(100),
  s_provider VARCHAR(20) NULL,
  s_token VARCHAR(200) NULL,
  s_status VARCHAR(20),
  dt_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (s_phone_number)
) ENGINE=InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI';


