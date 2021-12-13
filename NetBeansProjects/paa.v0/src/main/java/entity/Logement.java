/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entity;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.Basic;
import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.Lob;
import javax.persistence.ManyToOne;
import javax.persistence.OneToOne;
import javax.persistence.Table;
import javax.persistence.Temporal;
import javax.persistence.TemporalType;
import javax.xml.bind.annotation.XmlRootElement;

/**
 *
 * @author mathieudielna
 */

@Entity
@Table(name="logement")
@XmlRootElement
public class Logement implements Serializable{

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Basic(optional = false)
    @Column(name = "id_logement")
    private Integer idLogement;
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
    @OneToOne(cascade = CascadeType.ALL, mappedBy = "logement")
    private Maison maison;
    @JoinColumn(name = "id_type", referencedColumnName = "id_type")
    @ManyToOne(optional = false)
    private Type idType;
    @JoinColumn(name = "id_user", referencedColumnName = "id_user")
    @ManyToOne(optional = false)
    private User idUser;
    @JoinColumn(name = "idVille", referencedColumnName = "idVille")
    @ManyToOne(optional = false)
    private Ville idVille;

    public Logement() {
    }

    public Logement(Integer idLogement) {
        this.idLogement = idLogement;
    }

    public Logement(Integer idLogement, String description, String adresse, boolean status, float prix) {
        this.idLogement = idLogement;
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

    public Maison getMaison() {
        return maison;
    }

    public void setMaison(Maison maison) {
        this.maison = maison;
    }

    public Type getIdType() {
        return idType;
    }

    public void setIdType(Type idType) {
        this.idType = idType;
    }

    public User getIdUser() {
        return idUser;
    }

    public void setIdUser(User idUser) {
        this.idUser = idUser;
    }

    public Ville getIdVille() {
        return idVille;
    }

    public void setIdVille(Ville idVille) {
        this.idVille = idVille;
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
        if (!(object instanceof Logement)) {
            return false;
        }
        Logement other = (Logement) object;
        if ((this.idLogement == null && other.idLogement != null) || (this.idLogement != null && !this.idLogement.equals(other.idLogement))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "entity.Logement[ idLogement=" + idLogement + " ]";
    }
    
}
