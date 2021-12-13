/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entity;

import java.io.Serializable;
import java.util.Collection;
import javax.persistence.Basic;
import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Lob;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;

/**
 *
 * @author mathieudielna
 */

@Entity
@Table(name="type")
@XmlRootElement
public class Type implements Serializable {

    @OneToMany(cascade = CascadeType.ALL, mappedBy = "idType")
    private Collection<Maison> maisonCollection;
    @OneToMany(cascade = CascadeType.ALL, mappedBy = "idType")
    private Collection<Logement> logementCollection;

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Basic(optional = false)
    @Column(name = "id_type")
    private Integer idType;
    @Basic(optional = false)
    @Column(name = "libelle")
    private String libelle;
    @Basic(optional = false)
    @Column(name = "nbChambre")
    private int nbChambre;
    @Basic(optional = false)
    @Column(name = "nbSalleEau")
    private int nbSalleEau;
    @Basic(optional = false)
    @Column(name = "nbCuisine")
    private int nbCuisine;
    @Basic(optional = false)
    @Lob
    @Column(name = "description")
    private String description;

    public Type() {
    }

    public Type(Integer idType) {
        this.idType = idType;
    }

    public Type(Integer idType, String libelle, int nbChambre, int nbSalleEau, int nbCuisine, String description) {
        this.idType = idType;
        this.libelle = libelle;
        this.nbChambre = nbChambre;
        this.nbSalleEau = nbSalleEau;
        this.nbCuisine = nbCuisine;
        this.description = description;
    }

    public Integer getIdType() {
        return idType;
    }

    public void setIdType(Integer idType) {
        this.idType = idType;
    }

    public String getLibelle() {
        return libelle;
    }

    public void setLibelle(String libelle) {
        this.libelle = libelle;
    }

    public int getNbChambre() {
        return nbChambre;
    }

    public void setNbChambre(int nbChambre) {
        this.nbChambre = nbChambre;
    }

    public int getNbSalleEau() {
        return nbSalleEau;
    }

    public void setNbSalleEau(int nbSalleEau) {
        this.nbSalleEau = nbSalleEau;
    }

    public int getNbCuisine() {
        return nbCuisine;
    }

    public void setNbCuisine(int nbCuisine) {
        this.nbCuisine = nbCuisine;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (idType != null ? idType.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof Type)) {
            return false;
        }
        Type other = (Type) object;
        if ((this.idType == null && other.idType != null) || (this.idType != null && !this.idType.equals(other.idType))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "entity.Type[ idType=" + idType + " ]";
    }

    @XmlTransient
    public Collection<Maison> getMaisonCollection() {
        return maisonCollection;
    }

    public void setMaisonCollection(Collection<Maison> maisonCollection) {
        this.maisonCollection = maisonCollection;
    }

    @XmlTransient
    public Collection<Logement> getLogementCollection() {
        return logementCollection;
    }

    public void setLogementCollection(Collection<Logement> logementCollection) {
        this.logementCollection = logementCollection;
    }
    
}
