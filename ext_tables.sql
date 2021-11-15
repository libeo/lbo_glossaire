#
# Table structure for table 'tx_lboglossaire_domain_model_term'
#
CREATE TABLE tx_lboglossaire_domain_model_term
(
    term                  varchar(255) DEFAULT '' NOT NULL,
    description           text                    NOT NULL,
    hide_in_glossary_page tinyint(4) unsigned DEFAULT '0' NOT NULL,
);
