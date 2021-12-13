/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entity;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.Basic;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Lob;
import javax.persistence.Table;
import javax.persistence.Temporal;
import javax.persistence.TemporalType;
import javax.xml.bind.annotation.XmlRootElement;

/**
 *
 * @author mathieudielna
 */

@Entity
@Table(name="appartement")
@XmlRootElement
public class Appartement implements Serializable{

    @Id
    @Basic(optional = false)
    @Column(name = "id_logement")
    private Integer idLogement;
    @Basic(optional = false)
    @Column(name = "etage")
    private int etage;
    @Basic(optional = false)
    @Column(name = "ascenseur")
    private boolean ascenseur;
    @Basic(optional = false)
    @Lob
    @Column(name = "description")
    private String description;
    @Basic(optional = false)
    @Column(name = "adresse")
    private String adresse;
    @Basic(optional = false)
    @Column(name = "status")
    private boolean status;
    @Basic(optional = false)
    @Column(name = "prix")
    private float prix;
    @Column(name = "dateVente")
    @Temporal(TemporalType.DATE)
    private Date dateVente;

    public Appartement() {
    }

    public Appartement(Integer idLogement) {
        this.idLogement = idLogement;
    }

    public Appartement(Integer idLogement, int etage, boolean ascenseur, String description, String adresse, boolean status, float prix) {
        this.idLogement = idLogement;
        this.etage = etage;
        this.ascenseur = ascenseur;
        this.description = description;
        this.adresse = adresse;
        this.status = status;
        this.prix = prix;
    }

    public Integer getIdLogement() {
        return idLogement;
    }

    public void setIdLogement(Integer idLogement) {
        this.idLogement = idLogement;
    }

    public int getEtage() {
        return etage;
    }

    public void setEtage(int etage) {
        this.etage = etage;
    }

    public boolean getAscenseur() {
        return ascenseur;
    }

    public void setAscenseur(boolean ascenseur) {
        this.ascenseur = ascenseur;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getAdresse() {
        return adresse;
    }

    public void setAdresse(String adresse) {
        this.adresse = adresse;
    }

    public boolean getStatus() {
        return status;
    }

    public void setStatus(boolean status) {
        this.status = status;
    }

    public float getPrix() {
        return prix;
    }

    public void setPrix(float prix) {
        this.prix = prix;
    }

    public Date getDateVente() {
        return dateVente;
    }

    public void setDateVente(Date dateVente) {
        this.dateVente = dateVente;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (idLogement != null ? idLogement.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof Appartement)) {
            return false;
        }
        Appartement other = (Appartement) object;
        if ((this.idLogement == null && other.idLogement != null) || (this.idLogement != null && !this.idLogement.equals(other.idLogement))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "entity.Appartement[ idLogement=" + idLogement + " ]";
    }
    
}
